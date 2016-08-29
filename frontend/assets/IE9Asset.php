<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class IE9Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/ie.css',
    ];
    
    public $cssOptions = ['condition' => 'lt IE9'];
    
    public $js = [
        'js/html5.js',
    ];
    
    public $jsOptions = [
            'condition' => 'lt IE9',
            'position' => \yii\web\View::POS_HEAD,
        ];
    
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
