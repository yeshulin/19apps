<?php
namespace common\helpers;

/*
 *  邮件发送
 * */
use backend\models\Template;
use Yii;
use backend\models\search\MessageSearch;
use frontend\models\Member;

class Email
{
    static private $return = [
        "code" => "0000",
        "msg" => "success",
    ];
    /*
     *  type邮件类型
     * active 激活邮件
     * reg      注册邮件
     * password 重置密码
     * resetemail 邮箱修改
     * */
    static public function send($type = 'active', $email)
    {
        $return = self::$return;
        $params = Yii::$app->params;
        $time = time();
        Yii::info("邮箱验证码发送:start.", "apiLog");
        Yii::info("邮箱验证码发送:email." . $email, "apiLog");
        $emailpattern = "/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i";
//                $emailpattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (preg_match($emailpattern, $email)) {
            $member = Member::findByEmail($email, false);
            if (!empty($member) || $type == "reg") {

                $auth_key = md5($params['auth_key']);
                $code = Encrypt::sys_auth($email . "\t" . $time, 'ENCODE', $auth_key);
                Yii::info("邮箱验证码发送:info." . $email, "apiLog");
                Yii::info("邮箱验证码发送:code.", "apiLog");
                Yii::info("邮箱验证码发送:" . $code, "apiLog");

                $username = $member->username;
                $datetime = date("Y-m-d H:i:s");
                $date = date("Y-m-d");
                $picUrl = $params['picUrl'];
                if ($type == "active" || $type == "reg") {
//                    $url = 'http://' . $params['web_url'] . "/index.php?" . $params['register_route'] . "&" . $code;
                    $url = 'http://' . $params['web_url'] . "/" . $params['register_route'] . "?" . $code;
                } else {
                    // $url = 'http://' . $params['web_url'] . "/index.php?" . $params['fogetpwd_route'] . "&" . $code;
                    $url = 'http://' . $params['web_url'] . "/" . $params['fogetpwd_route'] . "?" . $code;
                }

                //模板处理
                $contents = Template::findOne(['name' => $type, "isworking" => 1]);
                if (!empty($contents)) {
                    $contentTem = $contents->content;
                    $message = str_replace(array('{picUrl}', '{username}','{click}', '{url}', '{datetime}', '{date}'), array($picUrl, $username, '<a href="' . $url . '">' . '</a>', $url, $datetime, $date), $contentTem);
                }else{
                    $return["code"] = "0001";
                    $return["msg"] = "failed";
                    $return["error"] = "没有相应的邮件模板";
                    return $return;
                }
                Yii::info("邮箱验证码发送:发送邮件.", "apiLog");
                $title = Template::getApplication(false, $type);
                $send = Yii::$app->mailer->compose()
                    ->setTo($email)
                    ->setSubject($title)
//            ->setTextBody("Yii邮件测试")
                    ->setHtmlBody($message)//发布可以带html标签的文本
                    ->send();
                if ($send) {
                    #code
                } else {
                    Yii::info("邮箱验证码发送:发送邮件失败.", "apiLog");
                    $return["code"] = "0001";
                    $return["msg"] = "failed";
                    $return["error"] = "发送邮件失败";
                }
//                        } else {
//                            Yii::info("邮箱验证码发送:没有配置系统邮箱.","apiLog");
//                            $this->setReturn2("0001","failed",'',"系统配置错误,请联系管理员");
//                        }
            } else {
                Yii::info("邮箱验证码发送:没有此邮箱.", "apiLog");
                $return["code"] = "0001";
                $return["msg"] = "failed";
                $return["error"] = "没有此邮箱";
            }
        } else {
            Yii::info("邮箱验证码发送:无效的邮箱.", "apiLog");
            $return["code"] = "0003";
            $return["msg"] = "failed";
            $return["error"] = "无效的邮箱";

        }
        Yii::info("邮箱验证码发送:end.", "apiLog");
        return $return;
//        Yii::info("邮箱验证码发送:end.".print_r($this->getReturn(),true),"apiLog");
//        $this->response->data=$this->getReturn();

    }
}

?>