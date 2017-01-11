<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%linkage}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parentid
 * @property integer $order
 * @property string $description
 */
class Linkage extends \yii\db\ActiveRecord
{
    public $items;

    private $linkages;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%linkage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parentid', 'order'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'parentid' => '父级ID',
            'order' => '排序',
            'description' => '说明',
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->parentid == null) {
            $this->parentid = 0;
        }
        if ($this->order == null) {
            $this->order = 0;
        }

        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }

    public function getLinkageList($parentid = 0){
        $linkages = [];
//        ini_set('memory_limit', '-1');
        $linkage = self::find()->select(['id', 'name'])->where(['parentid'=>$parentid])->orderBy(['order'=>SORT_DESC,'id'=>SORT_ASC])->asArray(true)->all();
        foreach ($linkage as $k => $v) {
            $linkages[$v['id']]['name'] = $v['name'];
            if (self::find()->where(['parentid'=>$v['id']])->one() !== null) {
                $linkages[$v['id']]['cell'] = $this->getLinkageList($v['id']);
            }
        }
        unset($linkage);
        return $linkages;
    }
}
