<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class LayoutAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/statics';
    public $jsOptions = [
        'position'=>View::POS_HEAD,
    ];

    public $css = [
        'css/font-awesome.min.css?v=4.3.0',
        'css/animate.min.css',
        'css/style.min.css?v=3.2.0',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
