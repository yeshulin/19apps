<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property string $id
 * @property string $trade_sn
 * @property integer $userid
 * @property string $contactname
 * @property string $phone
 * @property string $address
 * @property string $discount
 * @property string $price
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property OrderContent[] $orderContents
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
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
            [['trade_sn', 'type', 'userid', 'username', 'status', 'price', 'payid'], 'required'],
            [['phone'], 'integer'],
            [['userid'], 'integer'],
            [['discount', 'price'], 'number'],
            [['status'], 'string'],
            [['trade_sn', 'contactname'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 1000],
            [['remarks'], 'string', 'max' => 500],
            [['trade_sn'], 'unique'],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '订单类型',
            'payid' => '支付信息ID',
            'trade_sn' => '订单号',
            'userid' => '用户ID',
            'contactname' => '收货人姓名',
            'phone' => '收货人联系方式',
            'address' => '收获地址',
            'discount' => '优惠金额',
            'price' => '实际价格',
            'status' => '订单状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    public static function arrayAll($where, $page)
    {
        $pagesize = isset($page['pagesize']) ? intval($page['pagesize']) : 10;
        $page = isset($page['page']) ? intval($page['page']) : 1;

        $query = self::find();

        $totalCount = $query->where($where)->count();
        $page = $page > 0 ? $page : 1;
        $pagesize = $pagesize > 0 ? $pagesize : 1;
        if ($pagesize > 20) {
            $pagesize = 20;
        }
        $pages = ceil($totalCount / $pagesize);
        if ($age > $pages) {
            $page = $pages;
        }

        $arrayReust = null;
        $result = $query->where($where)->offset(($page - 1) * $pagesize)->orderBy(['created_at' => SORT_DESC])->limit($pagesize)->all();

        if ($result !== null) {
            foreach ($result as $key => $value) {
                $orderContents = $value->orderContents;
                $arrayReust[$key] = $value->getAttributes();
                $arrayReust[$key]['address'] = unserialize($arrayReust[$key]['address']);
                foreach ($orderContents as $k => $vo) {
                    $arrayReust[$key]['goods'][$k]['id'] = $vo->goods_id;
                    $arrayReust[$key]['goods'][$k]['price'] = $vo->price;
                    $arrayReust[$key]['goods'][$k]['num'] = $vo->num;
                    $arrayReust[$key]['goods'][$k]['goods_info'] = unserialize($vo->goods_info);
                    $arrayReust[$key]['goods'][$k]['attrs_info'] = unserialize($vo->attrs_info);
                }
            }
        }
        return [
            'data' => $arrayReust,
            'total' => $totalCount,
            'currentPage' => $page,
            'pageSize' => $pagesize,
        ];
    }

    public static function arrayOne($where)
    {
        $arrayReust = null;
        $result = static::find()->where($where)->one();
        if ($result !== null) {
            $orderContents = $result->orderContents;
            $arrayReust = $result->getAttributes();
            $arrayReust['address'] = unserialize($arrayReust['address']);
            foreach ($orderContents as $key => $value) {
                $arrayReust['goods'][$key]['id'] = $value->goods_id;
                $arrayReust['goods'][$key]['price'] = $value->price;
                $arrayReust['goods'][$key]['num'] = $value->num;
                $arrayReust['goods'][$key]['goods_info'] = unserialize($value->goods_info);
                $arrayReust['goods'][$key]['attrs_info'] = unserialize($value->attrs_info);
            }
        }
        return $arrayReust;
    }

    public function setStatus($id, $status)
    {
        if (($model = $this->findOne($id)) !== null) {
            $model->status = $status;
            if ($model->save()) {
                return true;
            }
        }
        $this->addError('id', '没有找到数据');
        return false;
    }

    public function payOK()
    {
        $payid = $this->payid;
        $this->status = 'success';
        $this->save();
    }

    public function getAddressInfo($address)
    {
        $address = unserialize($address);
        return $address['address'];
    }

    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            'status' => [
                'del' => '已删除',
                "unpay" => '订单创建',
                'success' => '订单完成',
                'cancel' => '已取消',
                'timeout' => '超时',
            ],
            'type' => [
                0 => '普通订单',
                1 => '议价订单',
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

    public static function generateStatus($status)
    {
        //$status = $model->status;
        switch ($status) {
            case 'del':
                $re = '已删除';
                break;
            case 'unpay':
                $re = '订单创建';
                break;
            case 'success':
                $re = '订单完成';
                break;
            case 'cancel':
                $re = '已取消';
                break;
            case 'timeout':
                $re = '超时';
                break;
            default:
                $re = '未知';
                break;
        }
        return $re;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPay()
    {
        return $this->hasOne(OrderPay::className(), ['id' => 'payid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderContents()
    {
        return $this->hasMany(OrderContent::className(), ['order_id' => 'id']);
    }
}
