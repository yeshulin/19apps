<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Member;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $mobile;
    static public $rules=[
        ['username', 'trim'],
        ['username', 'required'],
        ['username','match','pattern'=>'/^([a-zA-z])(\w*)$/','message'=>"用户名应以字母开头且不能包含中文"],
        ['username', 'unique', 'targetClass' => '\common\models\Member', 'message' => '用户名已注册'],
        ['username', 'string', 'min' => 4, 'max' => 20,'message'=>"用户名应为6-20个字符"],

        ['email', 'trim'],
        ['email', 'required'],
        ['email', 'email','message'=>"邮箱格式错误"],
        ['email', 'string', 'max' => 255],
        ['email', 'unique', 'targetClass' => '\common\models\Member', 'message' => '邮箱已注册'],

        ['mobile', 'trim'],
        ['mobile', 'required'],
        ['mobile','match','pattern'=>'/^[1][3578][0-9]{9}$/','message'=>"手机号码格式错误"],
        ['mobile', 'string', 'max' => 13],
        ['mobile', 'unique', 'targetClass' => '\common\models\Member', 'message' => '手机号码已注册'],

        ['password', 'required'],
        ['password', 'string', 'min' => 6,'max'=>16,'message'=>"密码应为6-16个字符"],
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return self::$rules;
    }
    public function delRules($attr,$value){
        foreach(self::$rules as $k => $val){
            if(in_array($attr,$val) && in_array($value,$val)){
                unset(self::$rules[$k]);
            }
        }
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($regStatus=0)
    {
        $info=array(
            'code'=>"0000",
            'data'=>''
        );
        if (!$this->validate()) {
            $info['code']="0001";
            $info['data']=$this->getErrors();
            return $info;
        }
        
        $user = new Member();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->mobile = $this->mobile;
        $user->regStatus = $regStatus;
        $user->generateAuthKey();
        $user->setPassword($this->password);
        if($user->save()){
            $info['data']=$user;
        }else{
            $info['code']="0001";
            $info['data']=$user->getErrors();
        }
        return $info;
    }
}
