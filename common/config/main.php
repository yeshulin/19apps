<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'=>'zh-CN',
    'sourceLanguage'=> 'zh-CN',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
