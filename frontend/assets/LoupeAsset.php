<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LoupeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'plugins/thdoan-magnify/dist/css/magnify.css',
    ];
    
    public $js = [
        'plugins/thdoan-magnify/dist/js/jquery.magnify.js',
        'plugins/thdoan-magnify/dist/js/jquery.magnify-mobile.js',
        'plugins/thdoan-magnify/dist/js/init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\AppAsset',
    ];
}
