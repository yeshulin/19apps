<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/mlv';
    public $css = [
        'css/amazeui.min.css',
        'css/mui.min.css'

    ];
    public $js = [
        'js/amazeui.min.js',
        'js/mui.min.js"'
    ];
    public $depends = [
//        'yii\web\YiiAsset',
    ];
}
