<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/statics';
    public $jsOptions = [
    ];

    public $css = [
    ];
    public $js = [
        'js/bootstrap.min.js?v=3.4.0',
        'js/plugins/metisMenu/jquery.metisMenu.js',
        'js/plugins/slimscroll/jquery.slimscroll.min.js',
        'js/plugins/layer/layer.min.js',
        'js/hplus.min.js?v=3.2.0',
        'js/contabs.min.js',
        'js/plugins/pace/pace.min.js',
    ];
    public $depends = [
        'backend\assets\LayoutAsset',
    ];
}
