<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/webSEO.php'),
    require(__DIR__ . '/routeTitle.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\Member',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                //add by zhaoxiaokang 160722
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['apiLog'],
                    'logFile' => '@app/runtime/logs/Api/api.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 20,
                ]
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/site/error'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ''=>'site/site',
                'api/goods/<method:\w+>' => 'api/goods/index',
                'api/goods/<type:view>/<id:\d+>' => 'api/goods/index',
                'api/course' => 'api/course/index',
                'api/course/<type:play>/<id:\d+>' => 'api/course/index',
                'api/course/<type:myfavorite>' => 'api/course/index',
            ],
        ],
    ],
    'modules' => [
        'user' => 'frontend\modules\user\module',
        'site' => 'frontend\modules\site\module',
    ],
    'params' => $params,
];
