<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/8
 * Time: 18:57
 */

namespace backend\assets;


use yii\web\AssetBundle;

class KindedtiorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/statics';
    public $css = [
        'js/plugins/kindeditor/themes/default/default.css',
    ];
    public $js = [
        'js/plugins/kindeditor/kindeditor-all-min.js',
//        'js/plugins/kindeditor/kindeditor-all.js',
        'js/plugins/kindeditor/lang/zh-CN.js',
    ];
    public $depends = [];
}