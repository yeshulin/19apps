<?php
namespace common\helpers;
/*
 *  消息发送，站内信
 * */
use backend\models\Template;
use Yii;
use backend\models\search\MessageSearch;
use frontend\models\Member;
class Message {
    static private $return=[
        "code"=>"0000",
        "msg"=>"success",
    ];
    /**
     * 发送消息
     * option
     * @fromUser    用户发送消息
     * @username    当前用户
     * @template    是否运用系统模板
     */
    // Message::send("zxk1234",'keyi','Test',["fromUser"=>true,'username'=>"hehe"]);
    static public function send($tousername='',$subject='',$content='',$option=[]) {

            //发送权限
            if(isset($option['fromUser']) && $option['fromUser']){
                #具体权限判断
                $username = $option['username'];
            }else{
                $username = Yii::$app->params['adminName'];
            }
            $return =self::$return;

            //内容处理
            $subject = htmlspecialchars($subject);
            $content = htmlspecialchars($content);

            //模板处理
            if(isset($option['template']) && $option['template']){
                $contents = Template::findOne(['name'=>"msg","isworking"=>1]);
                if(!empty($contents)){
                    $contentTem = $contents->content;
                    $content = str_replace(array('{content}'), array($content), $contentTem);
                }
            }

            //用户查找
            $member = Member::findByUsername($tousername);
            if(empty($member)){
                $return["code"]="0003";
                $return["msg"]="failed";
                $return['error']="没有这个用户";
                return $return;
            }

            //消息发送
            $message=new \backend\models\Message();
            $res=$message->add_message($tousername,$username,$subject,$content);
            if($res){
                return $return;
            }else{
                $return["code"]="0003";
                $return["msg"]="failed";
                $return['error']=$message->getErrors();
                return $return;
            }
    }
    /**
     * ajax发送消息
     */
    public function send_ajax() {
    }

    /*
     *判断收件人是否存在
     */
    public function public_name() {
    }

    /**
     * 发件箱
     */
    public function outbox() {
    }

    /**
     * 收件箱
     */
    public function inbox() {
    }

    /**
     * 群发邮件
     */
    public function group() {
    }

    /**
     * 删除收件箱-短消息
     * @param	intval	$sid	短消息ID，递归删除(修改状态为outbox)
     */
    public function delete() {
    }

    /**
     * 删除发件箱 - 短消息
     * @param	intval	$sid	短消息ID，递归删除( 修改状态为del_type =1 )
     */
    public function del_type() {
    }

    /**
     * 查看短消息 - 对当前用户是否有权限查看
     */
    public function check_user($messageid,$where){
    }


    /**
     * 查看短消息
     */
    public function read() {
    }

    /**
     * 查看详情
     */
    public function message_info()
    {
    }

    /**
     * 设置已读
     */
    public function set_read() {
    }

    /**
     * 全部设为已读
     */
    public function all_read()
    {
    }

    /**
     * 查看自己发的短消息
     */
    public function read_only() {
    }

    /**
     * 查看系统短消息
     */
    public function read_group(){
    }

    /**
     * 回复短消息
     */
    public function reply() {
    }


}
?>