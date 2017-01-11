<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%contactus}}".
 *
 * @property string $id
 * @property string $title
 * @property string $address
 * @property string $phone
 * @property string $fax
 * @property string $zipcode
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Contactus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contactus}}';
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
            [['title', 'city'], 'required'],
            [['created_at', 'status', 'sort'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 1000],
            [['phone', 'fax'], 'string', 'max' => 500],
            [['zipcode'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => '所在城市',
            'title' => '名称',
            'address' => '地址',
            'phone' => '联系电话',
            'fax' => '传真',
            'zipcode' => '邮编',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'status' => '状态',
            'sort' => '排序',
        ];
    }

    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            'status' => [
                1 => '正常',
                0 => '禁用',
            ],
            'city' => [
                'anhui' => '安徽',
                'beijing' => '北京',
                'chengdu' => '成都',
                'chongqing' => '重庆',
                'fujian' => '福建',
                'gansu' => '甘肃',
                'guangxi' => '广西',
                'guangzhou' => '广州',
                'guizhou' => '贵州',
                'hebei' => '河北',
                'heilongjiang' => '黑龙江',
                'henan' => '河南',
                'hubei' => '湖北',
                'hunan' => '湖南',
                'jiangsu' => '江苏',
                'jiangxi' => '江西',
                'jilin' => '吉林',
                'liaoning' => '辽宁',
                'neimeng' => '内蒙',
                'qinghai' => '青海',
                'shandong' => '山东',
                'shanghai' => '上海',
                'shanxi' => '陕西',
                'shanxitaiyuan' => '山西',
                'shenzhen' => '深圳',
                'tianjin' => '天津',
                'xinjiang' => '新疆',
                'xizang' => '西藏',
                'yunnan' => '云南',
                'zhejiang' => '浙江',
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
