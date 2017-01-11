<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets;

use DateInterval;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use IntlDateFormatter;
use NumberFormatter;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\helpers\FormatConverter;
use yii\helpers\HtmlPurifier;
use yii\helpers\Html;
use frontend\models\FormCollege;

/**
 * Formatter provides a set of commonly used data formatting methods.
 *
 * The formatting methods provided by Formatter are all named in the form of `asXyz()`.
 * The behavior of some of them may be configured via the properties of Formatter. For example,
 * by configuring [[dateFormat]], one may control how [[asDate()]] formats the value into a date string.
 *
 * Formatter is configured as an application component in [[\yii\base\Application]] by default.
 * You can access that instance via `Yii::$app->formatter`.
 *
 * The Formatter class is designed to format values according to a [[locale]]. For this feature to work
 * the [PHP intl extension](http://php.net/manual/en/book.intl.php) has to be installed.
 * Most of the methods however work also if the PHP intl extension is not installed by providing
 * a fallback implementation. Without intl month and day names are in English only.
 * Note that even if the intl extension is installed, formatting date and time values for years >=2038 or <=1901
 * on 32bit systems will fall back to the PHP implementation because intl uses a 32bit UNIX timestamp internally.
 * On a 64bit system the intl formatter is used in all cases if installed.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Enrica Ruedin <e.ruedin@guggach.com>
 * @author Carsten Brandt <mail@cebe.cc>
 * @since 2.0
 */
class Formatter extends \yii\i18n\Formatter
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    public function asStatus($value)
    {
        $status = '';
        switch ($value) {
            case 0:
                $status = "待审核";
                break;
            case 1:
                $status = "审核通过";
                break;
            case 2:
                $status = "未通过";
                break;
            default:
                break;
        }
        return $status;
    }

    public function asServerstatus($value)
    {
        $status = '';
        switch ($value) {
            case 0:
                $status = "删除/过期";
                break;
            case 1:
                $status = "开通中";
                break;
            case 2:
                $status = "使用中";
                break;
            default:
                break;
        }
        return $status;
    }

    public function asTongdao($value)
    {
//        $arr = [
//            "attrs" => [
//                0 => [
//                    "name" => "aa",
//                    "num" => 10
//                ]
//            ],
//            "goods_name" => "keyi"
//        ];
//        $value = serialize($arr);
        $good = unserialize($value);
        $str = "";
        if (empty($good['attrs'])) {
            $str .=  $good['goods_name'];
        } else {
            $str .= $good['goods_name'];
            $str .= "<br/>";
            foreach ($good['attrs'] as $k => $vo) {
                $str .= "&nbsp;&nbsp;";
                $str .= "[".$vo['name'] ."*". $vo['num']."]";
            }
        }
        return $str;
    }

    public function returnServerstatus()
    {
        $status = [
            0 => '删除/过期',
            1 => '开通中',
            2 => '使用中'
        ];
        return $status;
    }

    public function asActiveStatus($value)
    {
        $status = '';
        switch ($value) {
            case 1:
                $status = "未使用";
                break;
            case 2:
                $status = "已使用";
                break;
            default:
                break;
        }
        return $status;
    }

    public function returnActiveStatus()
    {
        return [
            1 => "未使用",
            2 => "已使用",
        ];
    }

    public function returnStatus()
    {
        return [
            0 => "待审核",
            1 => "审核通过",
            2 => "未通过",
        ];
    }

    public function asUsertype($value)
    {
        $status = '';
        switch ($value) {
            case 1:
                $status = "个人认证";
                break;
            case 2:
                $status = "企业认证";
                break;
            case 3:
                $status = "教育认证";
                break;
            default:
                break;
        }
        return $status;
    }

    public function returnUsertype()
    {
        return [
            1 => "个人认证",
            2 => "企业认证",
            3 => "教育认证",
        ];
    }

    public function asYYMM($value)
    {
        $value = intval($value / 30);
        $year = intval($value / 12);
        $month = $value % 12;
        $years = '';
        $months = '';
        if ($year) {
            $years = $year . Yii::t('backend', 'year');
        }
        if ($month) {
            $months = $month . Yii::t('backend', 'month');
        }

        return $years . $months;
    }

    public function asActiveType($value)
    {
        $return = \backend\models\ActivationCatlog::getList();
        if (isset($return[$value])) {
            return $return[$value];
        } else {
            return '';
        }
    }

    public function returnActiveType()
    {
        $return = \backend\models\ActivationCatlog::getList();
        return $return;
    }

    public function asPhoto($value)
    {
        $return = '';
        // $value= \common\helpers\Encrypt::string2array($value);
        // if(is_string($value)) $value= \common\helpers\Encrypt::string2array($value);
        $value = json_decode($value, true);
        // var_dump($value);exit;
        if (!empty($value)) {
            foreach ($value as $k => $photo) {
                $return .= "<span>";
                $return .= Html::img($photo['url'], ['alt' => $photo['alt']]);
                $return .= "</span>";
                // $return.=Html::img($photo,['width'=>'150px']);
            }
        }
        return $return;
    }

    public function asCollege($value)
    {
        $colleges = new FormCollege();
        $datas = $colleges->find()->all();
        foreach ($datas as $k => $data) {
            $tmpCollege = $data->toArray();
            $college[$tmpCollege['id']] = $tmpCollege['name'];
        }
        return isset($college[$value]) ? $college[$value] : "未设置";
    }

    public function returnCollege()
    {
        $college = [];
        $colleges = new \frontend\models\FormCollege();

        $datas = $colleges->find()->all();

        foreach ($datas as $k => $data) {
            $tmpCollege = $data->toArray();
            $college[$tmpCollege['id']] = $tmpCollege['name'];
        }
        return $college;
    }

    public function asDatetime2($value)
    {
        return date("Y/m/d H:i:s", $value);
    }
}
