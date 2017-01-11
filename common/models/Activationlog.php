<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%activationlog}}".
 *
 * @property integer $id
 * @property string $activ_code
 * @property integer $userid
 * @property integer $crated_at
 */
class Activationlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activationlog}}';
    }
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
            [['userid'], 'integer'],
            [['activ_code'], 'string', 'max' => 64],
        ];
    }
    public function checkUnique(){
        $info=static::findAll(['activ_code'=>$this->activ_code,'userid'=>$this->userid]);
        //var_dump($info);
        if($info){
            $this->addErrors(["log_code"=>"已使用的激活码!"]);
            return false;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activ_code' => '激活码',
            'userid' => '使用者ID',
            'created_at' => '激活时间',
            'updated_at' => '更新时间',
        ];
    }
}
