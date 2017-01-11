<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\custom;

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
    public function asStatus($value){
        $status='';
        switch($value){
            case 0:
                $status="待审核";
                break;
            case 1:
                $status="审核通过";
                break;
            case 2:
                $status="未通过";
                break;
            default:
                break;
        }
        return $status;
    }
    public function asUsertype($value){
        $status='';
        switch($value){
            case 1:
                $status="个人认证";
                break;
            case 2:
                $status="校企认证";
                break;
            default:
                break;
        }
        return $status;
    }
	public function asPhoto($value){
	$return='';
	if(is_string($value)) $value= \common\helpers\Encrypt::string2array($value);
		if(!empty($value)){
			foreach($value as $k=>$photo){
				$return.=Html::img($photo['url'],['alt'=>$photo['alt']]);
			}
		}
		return $return;
	}
}
