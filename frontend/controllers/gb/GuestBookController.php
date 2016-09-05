<?php
namespace frontend\controllers\gb;

use Yii;
use yii\helpers\Url;
use frontend\controllers\BaseFront;
use yii\data\Pagination;
use app\models\sections\Sections;


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
        return $this->render('index',[
                                        'section'           => $this->section,
//                                        'pageNum'           => $pageNum,
//                                        'paginCategories'   => $paginCategories,
//                                        'pagination'        => $pagination,
//                                        'totalCount'        => $totalCount
            
                                ]);
    }
    
   
}


