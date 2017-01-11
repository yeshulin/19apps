<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%activation_cat}}".
 *
 * @property string $id
 * @property string $cat_name
 * @property integer $product_id
 */
class ActivationCatlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activation_cat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'required'],
            [['product_id'], 'integer'],
            [['cat_name'], 'string', 'max' => 100],
        ];
    }
    static public function getList($id='',$type="id"){
        $catlogs='';
        $catlog = ActivationCatlog::find()->all();
        foreach($catlog as $k =>$val){
                if($type == "pid" && $val["product_id"] == $id){
                    continue;
                }
                $catlogs[$val['id']] = $val['cat_name'];
        }
        $arr=isset($catlogs[$id])?[$id=>$catlogs[$id]]:[];
        return $id?$arr:$catlogs;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_name' => '类型名称',
            'product_id' => '绑定商品',
        ];
    }
}
