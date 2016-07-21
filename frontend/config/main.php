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
//        'assetsAutoCompress' =>
//            [
//                'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
//                'enabled' => true,
//                'readFileTimeout' => 3,           //Time in seconds for reading each asset file
//                'jsCompress' => true,        //Enable minification js in html code
//                'jsCompressFlaggedComments' => true,        //Cut comments during processing js
//                'cssCompress' => true,        //Enable minification css in html code
//                'cssFileCompile' => true,        //Turning association css files
//                'cssFileRemouteCompile' => false,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
//                'cssFileCompress' => true,        //Enable compression and processing before being stored in the css file
//                'cssFileBottom' => false,       //Moving down the page css files
//                'cssFileBottomLoadOnJs' => false,       //Transfer css file down the page and uploading them using js
//                'jsFileCompile' => true,        //Turning association js files
//                'jsFileRemouteCompile' => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
//                'jsFileCompress' => true,        //Enable compression and processing js before saving a file
//                'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js
//                'htmlCompress' => true,        //Enable compression html
//                'htmlCompressOptions' =>              //options for compressing output result
//                    [
//                        'extra' => true,        //use more compact algorithm
//                        'no-comments' => true   //cut all the html comments
//                    ],
//            ],
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
            'identityCookie' => [
                'name' => '_frontendUser',
                'path' => '/'
            ]
        ],
        'session' => [
            'name' => '_frontendSessionId',
            'savePath' => sys_get_temp_dir(),
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
