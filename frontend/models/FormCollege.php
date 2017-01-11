<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%form_college}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $xiaoxun
 * @property string $info
 * @property integer $created_at
 * @property integer $update_at
 */
class FormCollege extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_college}}';
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
//            [['created_at', 'updated_at'], 'integer'],
            [['name', 'logo', 'xiaoxun', 'info'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '高校名称',
            'logo' => 'Logo',
            'xiaoxun' => '校训',
            'info' => '简介',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
