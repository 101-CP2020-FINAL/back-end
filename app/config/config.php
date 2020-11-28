<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$configLocal = [];
if (file_exists(__DIR__ . '/config-local.php')) {
    $configLocal = require __DIR__ . '/config-local.php';
}

$paramsLocal = [];
if (file_exists(__DIR__ . '/params-local.php')) {
    $paramsLocal = require __DIR__ . '/params-local.php';
}

$params = \yii\helpers\ArrayHelper::merge($params, $paramsLocal);

$config = [
    'id' => 'cp2020-final-back-end',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\api\internal\v1\ModuleBootstrap',
        'app\api\client\v1\ModuleBootstrap',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'ru-RU',
    'timeZone' => 'Europe/Moscow',
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass'  => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/admin' => 'site/index',
                '/admin/<controller>' => '<controller>',
                '/admin/<controller>/<action>' => '<controller>/<action>',
            ]
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*', '127.0.0.0'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];

//     $config['components']['assetManager']['forceCopy'] = true;
}

return \yii\helpers\ArrayHelper::merge($config, $configLocal);
