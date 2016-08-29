<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 *
 *  POS_HEAD: in the head section
    POS_BEGIN: at the beginning of the body section
    POS_END: at the end of the body section
    POS_LOAD: enclosed within jQuery(window).load(). Note that by using this position, the method will automatically register the jQuery js file.
    POS_READY: enclosed within jQuery(document).ready(). This is the default value. Note that by using this position, the method will automatically register the jQuery js file.
 *
 *
 *
 */
namespace frontend\assets;
use yii\web\AssetBundle;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ColorboxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/colorbox/example3/colorbox.css',//colorbox плагин для увеличения картинки при клике
    ];
    public $js = [
        'plugins/colorbox/jquery.colorbox-min.js',//colorbox плагин для увеличения картинки при клике
        'js/my.js',
    ];
//    public $jsOptions = [
//        'position' => \yii\web\View::POS_HEAD,
//    ];
    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\AppAsset'
//        'yii\bootstrap\BootstrapAsset',
    ];
}
