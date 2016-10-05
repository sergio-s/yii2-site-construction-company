<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/reset.css',
        'css/grid.css',
        'css/min/custom_bootstrap3/custom_bootstrap3.min.css',
        'css/font-awesome-4.6.3/css/font-awesome.min.css',
        'css/main.css',
    ];
    public $js = [
//        'js/jquery-1.11.3.min.js',
        'js/jquery.galleriffic.js',
        'js/jquery.opacityrollover.js',
        'plugins/jquery-color-master/jquery.color.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
