<?php

namespace frontend\themes\moderna\AssetsBundel;

use yii\web\AssetBundle;

class ModernaAsset extends AssetBundle {

    public $baseUrl = '@web';
    public $sourcePath = '@frontend/themes/moderna/AssetsBundel';
    public $publishOptions = ['forceCopy' => false];
    public $cssOptions = ['async' => 'async'];
    public $jsOptions = ['position' => \yii\web\View::POS_END, 'async' => 'async'];
    public $css = [
        'css/fonts.css',
        'css/flexslider.css',
        'css/style.css',
        'skins/default.css',
        'css/site.css',
        '/css/font-awesome.min.css',
    ];
    public $js = [
        //'js/jquery.easing.1.3.js',
        'js/jquery.fancybox.pack.js',
        'js/jquery.fancybox-media.js',
        //'js/google-code-prettify/prettify.js',
        'js/jquery.flexslider.js',
        // 'js/setting.js',
        //'js/animate.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $appendTimestamp = true;

}
