<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/statics';
    public $css = [
        'css/plugins/cropper/cropper.min.css',
        'js/plugins/kindeditor/themes/default/default.css',
    ];
    public $js = [
//        'js/plugins/prettyfile/bootstrap-prettyfile.js',
//        'js/plugins/datapicker/bootstrap-datepicker.js',
        'js/plugins/laydate/laydate.js',
        'js/plugins/photoClip/iscroll-zoom.js',
        'js/plugins/photoClip/jquery.photoClip.js',
        'js/plugins/kindeditor/kindeditor-all-min.js',
//        'js/plugins/kindeditor/kindeditor-all.js',
        'js/plugins/kindeditor/lang/zh-CN.js',
        'js/plugins/layer/layer.min.js',
    ];
    public $depends = [
        'backend\assets\LayoutAsset',
    ];
}
