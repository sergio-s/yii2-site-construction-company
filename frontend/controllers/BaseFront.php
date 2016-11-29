<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\services\settings\ISettingsService;
use common\services\settings\SettingsService;

/* 
 * FrontendController
 */
class BaseFront extends Controller
{
    // по умолчанию для всего сайта
    public $layout = '@app/views/layouts/tpl/page';
    
    protected $settingsService;

    public function __construct($id, $module, ISettingsService $settingsService, $config = [])
    {
        $this->settingsService = \Yii::$container->get(get_class($settingsService));
        
        parent::__construct($id, $module, $config);
    }

    
    
    
}

