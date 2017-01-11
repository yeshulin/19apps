<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%link_cate}}".
 *
 * @property string $linkcatid
 * @property string $name
 * @property integer $create_at
 */
class LinkCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link_cate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'linkcatid' => '分类ID',
            'name' => '名称',
            'create_at' => '创建时间',
        ];
    }

    public static function getCateData()
    {
        $data = self::find()->all();
        $result = [];
        foreach ($data as $model)
        {
            $result[$model->linkcatid] = $model->name;
        }
        return $result;
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at'],
                ],
            ],
        ];
    }

    public function getLink()
    {
        return $this->hasMany(Link::className(), ['linkcatid'=>'linkcatid']);
    }

}
