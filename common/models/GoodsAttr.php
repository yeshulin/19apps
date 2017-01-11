<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_attr}}".
 *
 * @property integer $goods_id
 * @property string $key
 * @property string $name
 * @property string $money
 * @property integer $attrtype
 * @property integer $uniquekey
 * @property integer $inputtype
 */
class GoodsAttr extends \yii\db\ActiveRecord
{
    const TYPE_TIME = 'time'; //时长
    const TYPE_MODULE = 'module'; //模块
    const TYPE_DEFINITION = 'definition'; //清晰度
    const TYPE_PEOPLE = 'people'; //人数
    const TYPE_OTHER = 'other'; //其他


    const INPUTTYPE_TEXT = 'text'; //输入文本
    const INPUTTYPE_CHECKBOX = 'checkbox'; // 多选
    const INPUTTYPE_RADIO = 'radio'; //单选

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_attr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'key', 'name', 'money', 'attrtype', 'inputtype'], 'required'],
            [['goods_id'], 'integer'],
            [['money'], 'number'],
            [['attrtype', 'inputtype'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 40],
            [['key', 'uniquekey'], 'string'],
//            [['key'],'match','pattern'=>'/^\w+$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => 'Goods ID',
            'key' => '键',
            'name' => '名称',
            'money' => '价格',
            'attrtype' => '参数类型',
            'uniquekey' => '唯一键',
            'inputtype' => '输入类型',
        ];
    }

    /**
     * 商品其他参数添加
     * @param $params
     * @param $id
     */
    public function replace($params, $id)
    {
        $this->deleteAll(['goods_id'=>$id]);
        $className = "GoodsAttr";
        if (!isset($params[$className]))
        {
            return false;
        }
        $goodsAttrData = $params[$className];
        if (!empty($goodsAttrData) && isset($goodsAttrData['attrtype']))
        {
            foreach ($goodsAttrData['attrtype'] as $k => $v)
            {
                $this->isNewRecord = true;
                $this->goods_id = $id;
                $this->attrtype = $v;
                $this->inputtype = $goodsAttrData['inputtype'][$k];
                $this->name = $goodsAttrData['name'][$k];
                $this->money = $goodsAttrData['money'][$k] ? $goodsAttrData['money'][$k] : 0;
                $this->key = $goodsAttrData['key'][$k];
                $this->uniquekey = strtoupper($this->attrtype.$this->inputtype.$this->goods_id.'I'.str_replace('.', '', number_format($this->money, 4)).'I'.$this->key);
                $this->save();
            }
        }
    }

    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            'attrtype' => [
                self::TYPE_TIME => '时长',
                self::TYPE_MODULE => '模块',
                self::TYPE_DEFINITION => '清晰度',
                self::TYPE_PEOPLE => '人数',
                self::TYPE_OTHER => '其他',
            ],
            'inputtype' => [
                self::INPUTTYPE_RADIO => '单选',
                self::INPUTTYPE_CHECKBOX => '多选',
                self::INPUTTYPE_TEXT => '文本',
            ],
        ];
        //根据具体值显示对应的值
        if ($value !== null) {
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
        }

        //返回关联数组，用户下拉的filter实现
        else {
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
        }
    }
}
