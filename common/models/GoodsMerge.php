<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_merge}}".
 *
 * @property integer $goods_id
 * @property integer $merge_goods_id
 */
class GoodsMerge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_merge}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'merge_goods_id'], 'required'],
            [[ 'merge_goods_id'], 'unique'],
            [['goods_id', 'merge_goods_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => 'Goods ID',
            'merge_goods_id' => 'Merge Goods ID',
        ];
    }

    /**
     * 写入组合商品
     * @param $model
     */
    public function rewiteMerge($model)
    {
        $GoodsMerge = explode(',', $model->goods_merge);
        $this->deleteAll(['goods_id' => $model->goods_id]);
        foreach ($GoodsMerge as $Merge) {
            $this->isNewRecord = true;
            $this->goods_id = $model->goods_id;
            $this->merge_goods_id = $Merge;
            if ($this->validate()) {
                $this->save();
            }
        }
    }
}
