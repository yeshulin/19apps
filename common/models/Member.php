<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class Member extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_NOACTIVE = 11;//未激活
    const DEFAULT_USERNAME = '华栖云学院';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED, self::STATUS_NOACTIVE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username, $active = false)
    {
        if (!$active) {
            return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        } else {
            return static::findOne(['username' => $username]);
        }
    }

    public static function findUser($info)
    {
        //username.email.mobile
        $type=self::login_type($info);
        switch($type){
            case 3://email
//                return static::findOne(['email' => $info, 'status' => self::STATUS_ACTIVE]);
                return static::find()->where("email = '$info' && regStatus !=1 ")->one();
                break;
            case 2://mobile
                return static::find()->where("mobile = '$info' &&  regStatus != 2 && regStatus != 3")->one();
                break;
            default:
                return static::findOne(['username' => $info]);
                break;
        }

    }

    public static function login_type($username = '')
    {
        $username = trim($username);
        if (empty($username)) {
            return 0;
        }
        $email_pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        $phone_pattern = "/^1[345678]\d{9}$/i";
        if (preg_match($email_pattern, $username)) {
            return 3;
        } elseif (preg_match($phone_pattern, $username)) {
            return 2;
        } else {
            return 1;
        }
    }

    /**
     * Finds username by userid
     * @param $userid
     * @return string
     */
    public static function findUsernameByUserid($userid)
    {
        if ($userid == 0) return self::DEFAULT_USERNAME;
        $user = self::findIdentity($userid);
        return $user ? $user->username : self::DEFAULT_USERNAME;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->encrypt;
//        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
//        return Yii::$app->security->validatePassword($password, $this->password_hash);
//        return $this->password_hash==md5(md5($password).$this->encrypt);
        return $this->password == md5(md5($password) . $this->encrypt);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
//        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
//        $this->password_hash=md5(md5($password).$this->encrypt);
        $this->password = md5(md5($password) . $this->encrypt);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->encrypt = Yii::$app->security->generateRandomString(6);
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
