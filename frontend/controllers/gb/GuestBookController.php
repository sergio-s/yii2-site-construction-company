<?php
namespace frontend\controllers\gb;

use Yii;
use yii\helpers\Url;
use frontend\controllers\BaseFront;
use yii\data\Pagination;
use app\models\sections\Sections;
use frontend\models\gb\GbForm;


/**
 * PageController
 */
class GuestBookController extends BaseFront
{
    private $pageSize = 6;//кол-во материалов на странице пагинации
    private $section;
    
    public function beforeAction($action) 
    {
        $this->section = Sections::getSectionFromName(Sections::SEC_GOEST_BOOK);
        
        if ($action->id === 'index') {
            $this->layout = '@app/views/layouts/tpl/photogalery';
        }
        return parent::beforeAction($action);
    }

    /**
     * Print home page.
     */
    public function actionIndex($pageNum = null)
    {
        $gbForm = new GbForm();
        
        if(Yii::$app->user->isGuest){
            $gbForm->scenario = GbForm::SCENARIO_GUEST;
        }else{
            $gbForm->scenario = GbForm::SCENARIO_REGISTERED;
        }
        
        return $this->render('index',[
                                        'section'        => $this->section,
                                        'gbForm'           => $gbForm,
//                                        'paginCategories'   => $paginCategories,
//                                        'pagination'        => $pagination,
//                                        'totalCount'        => $totalCount
            
                                ]);
    }
    
   
}


