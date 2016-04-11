<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
            'bundles' => [
                'all' => [
                    'class' => 'yii\web\AssetBundle',
                    'basePath' => '@webroot/assets',
                    'baseUrl' => '@web/assets',
                    'css' => ['all-xyz.css'],
                    'js' => ['all-xyz.js'],
                ],
                'yii\web\JqueryAsset' => ['js' => ['jquery.min.js']],
                'yii\bootstrap\BootstrapAsset' => ['css' => ['css/bootstrap.min.css']],
                'yii\bootstrap\BootstrapPluginAsset' => ['js' => ['js/bootstrap.min.js']]
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'rules' => [
                'page/<page>' => '/site/static',
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '',
                'pathMap' => ['@app/views' => '@frontend/themes/moderna'],
                'baseUrl' => '@web/'
            ]
        ],
    ],
    'params' => $params,
];
