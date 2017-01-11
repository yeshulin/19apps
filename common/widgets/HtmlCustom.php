<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets;

use yii\helpers;
/**
 * Html provides a set of static methods for generating commonly used HTML tags.
 *
 * Nearly all of the methods in this class allow setting additional html attributes for the html
 * tags they generate. You can specify for example. 'class', 'style'  or 'id' for an html element
 * using the `$options` parameter. See the documentation of the [[tag()]] method for more details.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HtmlCustom extends \yii\helpers\Html
{
public static function imgs($src, $options = [])
    {
	$imgs='';
	// $src=\common\helpers\Encrypt::string2array($src);
	$src=json_decode($src,true);
	foreach($src as $k=>$url){
        $options['src'] = \yii\helpers\Url::to($url);
        if (!isset($options['alt'])) {
            $options['alt'] = $url['alt'];
        }
		$imgs.="<span style='margin:20px 20px;display:inline-block'>";
        $imgs.=static::tag('img', '', $options);
		$imgs.="</span>";
	}
	return $imgs;
    }
}
