<?php
namespace frontend\controllers\api;

use common\helpers\Email;
use Yii;
use frontend\controllers;
use frontend\models\Sms;
use frontend\models\Member;

class SmsController extends ApiController
{

    private $sms;
    private $yzm_time = 600;//验证有效时间
	public $allowHash=false;
//    public function __construct() {
//        $session_storage = 'session_'.pc_base::load_config('system','session_storage');
//        pc_base::load_sys_class($session_storage);
//
//    }
    //密码找回
    public function init()
    {
//        $this->tokenCheck();
        //$this->isGuest();
        header("Access-Control-Allow-Origin: *");
        parent::init();
        $this->sms = New Sms();
//        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        $this->response = \Yii::$app->response;
//        $this->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function afterAction()
    {
        //$this->response->data = parent::$return;
    }

    /*
     * 短信发送
     * */
    public function actionSend()
    {
        Yii::info("短信验证码发送:start", "apiLog");
        $time = time();
        if (Yii::$app->request->isPost) {
            Yii::info("接收Json数据." . print_r($this->rawBody, true), "apiLog");
            if (isset($this->rawBody['mobile']) && $this->rawBody['mobile'] != '') {
                $mobile = $this->rawBody['mobile'];
                if (preg_match('/^1[0-9]{10}$/', $mobile)) {
                    $member = Member::findByMobile($mobile);
                    if (!empty($member) || (isset($this->rawBody['isReg']) && $this->rawBody['isReg'])) {
                        Yii::info("短信验证码发送:发送次数." . isset($_SESSION['forPassNum']) ? $_SESSION['forPassNum'] : 0, "apiLog");
                        if (!isset($_SESSION['forPassNum'])) {
                            $_SESSION['forPassNum'] = 0;
                        } elseif ($_SESSION['forPassNum'] > 4) {
                            Yii::info("短信验证码发送:已达到发送次数限制.", "apiLog");
                            $this->setReturn("0003", "failed", '', "已达到发送次数限制");
                        }
                        $_SESSION['forPassNum'] += 1;
                        $posttime = strtotime(date("Y-m-d"));
//                    $where = "slec`mobile`='$mobile' AND `posttime`>'$posttime' AND `return_id`=2";
//                    $where = "`mobile`=".$mobile;
                        $smsFind = Sms::find()->andFilterWhere(['mobile' => $mobile]);
                        $smsFind->andFilterWhere(
                            [">=", "posttime", $posttime],
                            ["return_id" => 2]);
                        $num = $smsFind->count();
                        if ($num > 4) {
                            Yii::info("短信验证码发送:今日已达到发送次数限制.", "apiLog");
                            $this->setReturn("0003", "failed", '', "今日已达到发送次数限制");
                        }
                        $c = mt_rand(10000, 99999);
                        $code = $c;
                        Yii::info("短信验证码发送:验证码." . $code, "apiLog");

//                    $_SESSION['yzm'] = $code;
//                    $_SESSION['sobeyForPass'] = md5($mobile . $code . "sobey@2014");
                        $mobile = (string)$mobile;
                        Yii::$app->session->set('yzm', $code);
                        Yii::$app->session->set('yzm_mobile', $mobile);
                        Yii::$app->session->set('yzm_time', $time + $this->yzm_time);
                        Yii::$app->session->set('sobeyForPass', md5($mobile . $code . "sobey@2014"));
                        Yii::info("短信验证码发送:开始发送.", "apiLog");
                        $arr = $this->tpl_send_sms('7ad8b7b3d27f2ef35a9b412dcf140ff4', '367031', '#code#=' . $code, $mobile);
                        if ($arr['code'] == 0) {
                            $ip = Yii::$app->request->getUserIP();
                            //$this->sms->load(array("Sms" => array('mobile' => $mobile, 'posttime' => $time, 'id_code' => $code, 'send_userid' => 0, 'status' => 0, 'msg' => 0, 'return_id' => 2, 'ip' => $ip)));
//                    $this->sms->save();
                            $model = new Sms();
//                    if ($model->load(json_encode(Yii::$app->request->getRawBody(),true)) && $model->save()) {
                            $model->load(array("Sms" => array(
                                'mobile' => $mobile,
                                'posttime' => $time,
                                'id_code' => $code,
                                'send_userid' => 0,
                                'status' => 0,
                                'msg' => 0,
                                'return_id' => 2,
                                'ip' => $ip
                            )));
                            if (!$model->save()) {
                                Yii::info("短信验证码发送:保存发送信息失败.", "apiLog");
                                $this->setReturn("0001", "failed", '', $model->getErrors());
                            }
                        } else {
                            Yii::info("短信验证码发送:短信发送失败." . print_r($arr, true), "apiLog");
                            $this->setReturn("0001", "failed", '', "系统繁忙，短信发送失败");
                        }
                    } else {
                        Yii::info("短信验证码发送:没有匹配到这个电话号码", "apiLog");
                        $this->setReturn("0003", "failed", '', "没有匹配到这个电话号码");
                    }
                } else {
                    Yii::info("短信验证码发送:错误的电话号码格式", "apiLog");
                    $this->setReturn("0003", "failed", '', "错误的电话号码格式");
                }
            } else {
                Yii::info("短信验证码发送:手机号码为空", "apiLog");
                $this->setReturn("0003", "failed", '', "手机号码为空");
            }
        } else {
            Yii::info("短信验证码发送:非Post请求", "apiLog");
            $this->setReturnUsePost();
        }
        Yii::info("短信验证码发送:end", "apiLog");
//        Yii::info("短信验证码发送:end.".print_r($this->getReturn(),true),"apiLog");
        $this->setReturn();
//        $this->response->data=$this->getReturn();
    }

    public function actionEmail($type= "", $email = '')
    {
        //Email::send("resetemail",$email);
        Yii::info("邮箱验证码发送:start.", "apiLog");
        if (Yii::$app->request->isPost) {
            Yii::info("接收Json数据." . print_r($this->rawBody, true), "apiLog");
            if ((isset($this->rawBody['email']) && $this->rawBody['email'] != '' && isset($this->rawBody['type']) && $this->rawBody['type'] != '') || !empty($email)) {
                $email = $email ? $email : $this->rawBody['email'];
                $type = $type ? $type : $this->rawBody['type'];
                $info = Email::send($type,$email);
                if($info['code']=="0000") {
                    $this->setReturn($info['code'], $info['msg'], $info['success']);
                }else{
                    $this->setReturn($info['code'], $info['msg'],'', $info['error']);
                }
//                $active = isset($this->rawBody['isActive']) ? $this->rawBody['isActive'] : false;
//                $params = Yii::$app->params;
//                $email_config = $params['email_common'];
//                Yii::info("邮箱验证码发送:获取邮箱配置.", "apiLog");
//                $time = time();
//                //SMTP MAIL 二种发送模式
//                if ($email_config['mail_type'] == '1') {
//                    if (empty($email_config['mail_user']) || empty($email_config['mail_password'])) {
//                        Yii::info("邮箱验证码发送:邮箱配置错误mail_user，mail_password.", "apiLog");
//                        $this->setReturn2("0001", "failed", '', "系统邮箱出错", $reg);
//                    }
//                }
//
//                $member_setting = Yii::$app->params['member_common'];
//                $memberinfo = "";
//                $memberinfo['email'] = "";
//                $emailpattern = "/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i";
////                $emailpattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
//                if (preg_match($emailpattern, $email)) {
//                    $member = Member::findByEmail($email, false);
//                    if (!empty($member) || (isset($this->rawBody['isReg']) && $this->rawBody['isReg']) || $reg || $active) {
////                        $memberinfo['email'] = $member->email;
////                        $memberinfo['userid'] = $member->id;
////            var_dump($memberinfo);exit;
////                        if (!empty($memberinfo['email'])) {
////                            $email = $memberinfo['email'];
//                        $auth_key = md5($params['auth_key']);
//
//                        $code = $this->sys_auth($email . "\t" . $time, 'ENCODE', $auth_key);
//                        Yii::info("邮箱验证码发送:info." . $email, "apiLog");
//                        Yii::info("邮箱验证码发送:code.", "apiLog");
//                        Yii::info("邮箱验证码发送:" . $code, "apiLog");
////                            $url = 'http://' . $params['web_url'] . "/index.php?" . $params['fogetpwd_route'] . "/" . $code;
////                            $message = $member_setting['forgetpassword'];registerverifymessage
//                        $username = $member->username;
//                        $datetime = date("Y-m-d H:i:s");
//                        $date = date("Y-m-d");
//                        $picUrl = $member_setting['picUrl'];
//                        if ($reg || $active) {
//                            $action = "验证邮箱";
//                            $title = "用户激活";
//                            $message = $member_setting['registerverifymessage'];
//                            $url = 'http://' . $params['web_url'] . "/index.php?" . $params['register_route'] . "&" . $code;
//                        } else {
//                            $action = "重置密码";
//                            $title = "忘记密码";
//                            $message = $member_setting['registerverifymessage'];
//                            $url = 'http://' . $params['web_url'] . "/index.php?" . $params['fogetpwd_route'] . "&" . $code;
//                        }
//                        $message = str_replace(array('{picUrl}', '{username}', '{click}', '{url}', '{datetime}', '{date}', '{action}'), array($picUrl, $username, '<a href="' . $url . '">' . $click . '</a>', $url, $datetime, $date, $action), $message);
//
//                        $sitename = '华栖云学院 _MAIL';
//                        Yii::info("邮箱验证码发送:发送邮件.", "apiLog");
//                        if ($this->sendmail($email, $title, $message, '', '', $sitename)) {
//                            #code
//                        } else {
//                            Yii::info("邮箱验证码发送:发送邮件失败.", "apiLog");
//                            $this->setReturn2("0001", "failed", '', "发送邮件失败", $reg);
//                        }
////                        } else {
////                            Yii::info("邮箱验证码发送:没有配置系统邮箱.","apiLog");
////                            $this->setReturn2("0001","failed",'',"系统配置错误,请联系管理员");
////                        }
//                    } else {
//                        Yii::info("邮箱验证码发送:没有此邮箱.", "apiLog");
//                        $this->setReturn2("0001", "failed", '', "没有此邮箱", $reg);
//                    }
//                } else {
//                    Yii::info("邮箱验证码发送:无效的邮箱.", "apiLog");
//                    $this->setReturn2("0001", "failed", '', "无效的邮箱", $reg);
//                }
            } else {
                Yii::info("邮箱验证码发送:缺少参数.", "apiLog");
                $this->setReturn2("0001", "failed", '', "缺少参数", $reg);
            }
        } else {
            Yii::info("邮箱验证码发送:非Post请求.", "apiLog");
            $this->setReturnUsePost();
        }
        Yii::info("邮箱验证码发送:end.", "apiLog");
//        Yii::info("邮箱验证码发送:end.".print_r($this->getReturn(),true),"apiLog");
//        $this->response->data=$this->getReturn();
        $this->setReturn2('', '', '', '', $reg);

    }

    public function setReturn2($code = '', $msg = '', $success = '', $error = '', $return = false)
    {
        if ($return) {
            return [
                "code" => $code,
                "msg" => $msg,
                "success" => $success,
                "error" => $error,
            ];
        } else {
            $this->setReturn($code, $msg, $success, $error);
        }
    }

    public function tpl_send_sms($apikey = '7ad8b7b3d27f2ef35a9b412dcf140ff4', $tpl_id = '', $tpl_value = '#code#=123456', $mobile)
    {
        $url = "http://yunpian.com/v1/sms/tpl_send.json";
        $encoded_tpl_value = urlencode("$tpl_value");
        $post_string = "apikey=$apikey&tpl_id=$tpl_id&tpl_value=$encoded_tpl_value&mobile=$mobile";
        return $this->sock_post($url, $post_string);
    }

    function sock_post($url, $query)
    {
        $data = "";
        $info = parse_url($url);
        $fp = fsockopen($info["host"], 80, $errno, $errstr, 30);
        if (!$fp) {
            return $data;
        }
        $head = "POST " . $info['path'] . " HTTP/1.0\r\n";
        $head .= "Host: " . $info['host'] . "\r\n";
        $head .= "Referer: http://" . $info['host'] . $info['path'] . "\r\n";
        $head .= "Content-type: application/x-www-form-urlencoded\r\n";
        $head .= "Content-Length: " . strlen(trim($query)) . "\r\n";
        $head .= "\r\n";
        $head .= trim($query);
        $write = fputs($fp, $head);
        $header = "";
        while ($str = trim(fgets($fp, 4096))) {
            $header .= $str;
        }
        while (!feof($fp)) {
            $data .= fgets($fp, 4096);
        }
        return $data;
    }

    /**
     * 验证验证码
     */
    public function actionYanzheng($json = true)
    {
        if (Yii::$app->request->isPost) {
            Yii::info("接收Json数据." . print_r($this->rawBody, true), "apiLog");
//            if (isset($this->rawBody['mobile_verify']) && $this->rawBody['mobile_verify'] != '' && isset($this->rawBody['mobile']) && $this->rawBody['mobile'] != '') {
            if (isset($this->rawBody['mobile_verify']) && $this->rawBody['mobile_verify'] != '') {
                $code = trim($this->rawBody['mobile_verify']);
                $time = time();
                $mobile = trim($this->rawBody['mobile']);
                $scode = Yii::$app->session->get('yzm');
                $sobeyForPass = Yii::$app->session->get('sobeyForPass');
                if (($code != $scode)  ||  $time > Yii::$app->session->get('yzm_time')) {
//                if (($code != $scode) || $sobeyForPass != md5($mobile . $scode . "sobey@2014") && $time > Yii::$app->session->get('yzm_time')) {
                    $this->setReturn("0003", "failed", '', "验证码错误");
                } else {
                    Yii::$app->session->set('yzm', '');
                    Yii::$app->session->set('sobeyForPass', '');
//                    Yii::$app->session->set('yzm_mobile', '');
                    Yii::$app->session->set('yzm_time', '');
                }
            } else {
                $this->setReturn("0003", "failed", '', "空的验证码或手机号码");
            }
        } else {
            $this->setReturnUsePost();
        }
        if ($json) {
            $this->setReturn();
//            $this->response->data=parent::$return;
        } else {
//            return parent::$return;
            $return['code'] = "0000";
            return $return;
        }
    }

    public function emailCode()
    {
        session_start();
        $code = strtolower(trim($_POST['code']));
        $scode = strtolower($_SESSION['code']);
        if ($code == $scode && $code !== "") {
            echo 0;
            exit;
        } else {
            echo 1;
            exit;
        }
    }

    /**
     * 密码找回验证验证码
     */
    public function forpassyz()
    {
        $code = trim($_GET['mobile_verify']);
        $scode = $_SESSION['yzm'];
        if ($code == $scode) {
            echo 0;
        } else {
            echo 1;
        }
    }

    public function yzcode()
    {
        $code = trim(strtolower($_POST['code']));
        if ($code == $_SESSION['code']) {
            echo 1;
        } else {
            echo 0;
        }
    }

    /**
     * 发送邮件
     * @param $toemail 收件人email
     * @param $subject 邮件主题
     * @param $message 正文
     * @param $from 发件人
     * @param $cfg 邮件配置信息
     * @param $sitename 邮件站点名称
     */

    function sendmail($toemail, $subject, $message, $from = '', $cfg = array(), $sitename = '')
    {
        if ($sitename == '') {
//            $siteid = get_siteid();
//            $siteinfo = siteinfo($siteid);
//            $sitename = $siteinfo['site_title'];
        }

        if ($cfg && is_array($cfg)) {
            $from = $cfg['from'];
            $mail = $cfg;
            $mail_type = $cfg['mail_type']; //邮件发送模式
        } else {
            $cfg = Yii::$app->params['email_common'];
            $from = $cfg['mail_from'];
            $mail_type = $cfg['mail_type']; //邮件发送模式
            if ($cfg['mail_user'] == '' || $cfg['mail_password'] == '') {
                return false;
            }
            $mail = Array(
                'mailsend' => 2,
                'maildelimiter' => 1,
                'mailusername' => 1,
                'server' => $cfg['mail_server'],
                'port' => $cfg['mail_port'],
                'auth' => $cfg['mail_auth'],
                'from' => $cfg['mail_from'],
                'auth_username' => $cfg['mail_user'],
                'auth_password' => $cfg['mail_password']
            );
        }
        //mail 发送模式
        define("CHARSET", "UTF-8");
        if ($mail_type == 0) {
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=' . CHARSET . '' . "\r\n";
            $headers .= 'From: ' . $sitename . ' <' . $from . '>' . "\r\n";
            mail($toemail, $subject, $message, $headers);
            return true;
        }
        //邮件头的分隔符
        $maildelimiter = $mail['maildelimiter'] == 1 ? "\r\n" : ($mail['maildelimiter'] == 2 ? "\r" : "\n");
        //收件人地址中包含用户名
        $mailusername = isset($mail['mailusername']) ? $mail['mailusername'] : 1;
        //端口
        $mail['port'] = $mail['port'] ? $mail['port'] : 25;
        $mail['mailsend'] = $mail['mailsend'] ? $mail['mailsend'] : 1;

        //发信者
        $email_from = $from == '' ? '=?' . CHARSET . '?B?' . base64_encode($sitename) . "?= <" . $from . ">" : (preg_match('/^(.+?) \<(.+?)\>$/', $from, $mats) ? '=?' . CHARSET . '?B?' . base64_encode($mats[1]) . "?= <$mats[2]>" : $from);

        $email_to = preg_match('/^(.+?) \<(.+?)\>$/', $toemail, $mats) ? ($mailusername ? '=?' . CHARSET . '?B?' . base64_encode($mats[1]) . "?= <$mats[2]>" : $mats[2]) : $toemail;;

        $email_subject = '=?' . CHARSET . '?B?' . base64_encode(preg_replace("/[\r|\n]/", '', '[' . $sitename . '] ' . $subject)) . '?=';
        $email_message = chunk_split(base64_encode(str_replace("\n", "\r\n", str_replace("\r", "\n", str_replace("\r\n", "\n", str_replace("\n\r", "\r", $message))))));

        $headers = "From: $email_from{$maildelimiter}X-Priority: 3{$maildelimiter}X-Mailer: PHPCMS-V9 {$maildelimiter}MIME-Version: 1.0{$maildelimiter}Content-type: text/html; charset=" . CHARSET . "{$maildelimiter}Content-Transfer-Encoding: base64{$maildelimiter}";

        if (!$fp = fsockopen($mail['server'], $mail['port'], $errno, $errstr, 30)) {
            Yii::info('SMTP' . "($mail[server]:$mail[port]) CONNECT - Unable to connect to the SMTP server" . 0, 'apiLog');
            return false;
        }
        stream_set_blocking($fp, true);

        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != '220') {
            Yii::info('SMTP' . "$mail[server]:$mail[port] CONNECT - $lastmessage" . 0, "apiLog");
            return false;
        }

        fputs($fp, ($mail['auth'] ? 'EHLO' : 'HELO') . " phpcms\r\n");
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != 220 && substr($lastmessage, 0, 3) != 250) {
            Yii::info('SMTP' . "($mail[server]:$mail[port]) HELO/EHLO - $lastmessage" . 0, "apiLog");
            return false;
        }

        while (1) {
            if (substr($lastmessage, 3, 1) != '-' || empty($lastmessage)) {
                break;
            }
            $lastmessage = fgets($fp, 512);
        }

        if ($mail['auth']) {
            fputs($fp, "AUTH LOGIN\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 334) {
                Yii::info('SMTP' . "($mail[server]:$mail[port]) AUTH LOGIN - $lastmessage" . 0, "apiLog");
                return false;
            }

            fputs($fp, base64_encode($mail['auth_username']) . "\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 334) {
                Yii::info('SMTP' . "($mail[server]:$mail[port]) USERNAME - $lastmessage" . 0, "apiLog");
                return false;
            }

            fputs($fp, base64_encode($mail['auth_password']) . "\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 235) {
                Yii::info('SMTP' . "($mail[server]:$mail[port]) PASSWORD - $lastmessage" . 0, "apiLog");
                return false;
            }

            $email_from = $mail['from'];
        }

        fputs($fp, "MAIL FROM: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from) . ">\r\n");
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != 250) {
            fputs($fp, "MAIL FROM: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from) . ">\r\n");
            $lastmessage = fgets($fp, 512);
            if (substr($lastmessage, 0, 3) != 250) {
                Yii::info('SMTP' . "($mail[server]:$mail[port]) MAIL FROM - $lastmessage" . 0, "apiLog");
                return false;
            }
        }

        fputs($fp, "RCPT TO: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $toemail) . ">\r\n");
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != 250) {
            fputs($fp, "RCPT TO: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $toemail) . ">\r\n");
            $lastmessage = fgets($fp, 512);
            Yii::info('SMTP' . "($mail[server]:$mail[port]) RCPT TO - $lastmessage" . 0, "apiLog");
            return false;
        }

        fputs($fp, "DATA\r\n");
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != 354) {
            Yii::info('SMTP' . "($mail[server]:$mail[port]) DATA - $lastmessage" . 0, "apiLog");
            return false;
        }

        $headers .= 'Message-ID: <' . gmdate('YmdHs') . '.' . substr(md5($email_message . microtime()), 0, 6) . rand(100000, 999999) . '@' . $_SERVER['HTTP_HOST'] . ">{$maildelimiter}";

        fputs($fp, "Date: " . gmdate('r') . "\r\n");
        fputs($fp, "To: " . $email_to . "\r\n");
        fputs($fp, "Subject: " . $email_subject . "\r\n");
        fputs($fp, $headers . "\r\n");
        fputs($fp, "\r\n\r\n");
        fputs($fp, "$email_message\r\n.\r\n");
        $lastmessage = fgets($fp, 512);
        if (substr($lastmessage, 0, 3) != 250) {
            Yii::info('SMTP' . "($mail[server]:$mail[port]) END - $lastmessage" . 0, "apiLog");
        }
        fputs($fp, "QUIT\r\n");
        return true;
    }
}
