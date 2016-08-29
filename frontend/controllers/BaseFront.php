<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;


/* 
 * FrontendController
 */
class BaseFront extends Controller
{
    // по умолчанию для всего сайта
    public $layout = '@app/views/layouts/tpl/page';
    
}

