<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * frontend application asset bundle.
 */
class GuestBookAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/gb.css',
    ];
    
    public $js = [
        'js/guest-book.js',
        
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\AppAsset',
    ];
    
    
}

