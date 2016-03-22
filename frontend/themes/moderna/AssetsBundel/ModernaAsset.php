<?php

namespace frontend\themes\moderna\AssetsBundel;

use yii\web\AssetBundle;

class ModernaAsset extends AssetBundle {

    public $baseUrl = '@web';
    public $sourcePath = '@webroot/..//themes/moderna/AssetsBundel';
    public $publishOptions = [
        'forceCopy' => true,
    ];
    //public $cssOptions = ["media" => "none","onload"=>"if(media!='all')media='all'"];
    public $jsOptions = ['position' => \yii\web\View::POS_END, 'async' => 'async',];
    public $css = [
        'http://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700|Open+Sans:300,400,600,700',
        'js/google-code-prettify/prettify.css',
        'css/font-awesome.css',
        'css/fancybox/jquery.fancybox.css',
        'css/overwrite.css',
        'css/animate.css',
        'css/flexslider.css',
        'css/style.css',
        '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
        'skins/default.css',
        'css/site.css'
    ];
    public $js = [
        'js/jquery.easing.1.3.js',
        'js/jquery.fancybox.pack.js',
        'js/jquery.fancybox-media.js',
        'js/google-code-prettify/prettify.js',
        'js/jquery.flexslider.js',
        'js/setting.js',
        'js/animate.js',
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
