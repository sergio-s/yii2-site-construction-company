<?php
namespace frontend\controllers\photo;

use Yii;
use yii\helpers\Url;
use frontend\controllers\BaseFront;
use yii\data\Pagination;
use app\models\sections\Sections;
use app\models\photo\SectionPhotogaleryCategory;
use app\models\photo\SectionPhotogaleryImg;

/**
 * PageController
 */
class PhotoController extends BaseFront
{
    use \common\traits\PageHelper;
    
    private $pageSize = 6;//кол-во материалов на странице пагинации
    private $section;
    
    public function beforeAction($action) 
    {
        $this->section = Sections::getSectionFromName(Sections::SEC_PHOTOGALERY);
        
        if ($action->id === 'index' || $action->id == 'category') {
            $this->layout = '@app/views/layouts/tpl/photogalery';
        }
        return parent::beforeAction($action);
    }

    /**
     * Print home page.
     */
    public function actionIndex($pageNum = null)
    {
        //построение постраничной навигации
        $query = SectionPhotogaleryCategory::getAllCatsPagin();
        $redirectFromNum1 = Url::toRoute(['/photo/index'], true);
        list($pagination, $paginCategories, $totalCount) = static::buildPagination($query, $this->pageSize, $pageNum, $redirectFromNum1);
        
        static::buildMetaTags($this->section->title, $this->section->description, $this->section->keywords, $pageNum);
        
        return $this->render('index',[
                                        'section'           => $this->section,
                                        'pageNum'           => $pageNum,
                                        'paginCategories'   => $paginCategories,
                                        'pagination'        => $pagination,
                                        'totalCount'        => $totalCount
            
                                ]);
    }
    
    public function actionCategory($alias = null)
    {
        $category = SectionPhotogaleryCategory::getCategoryFromAlias($alias);
        $pics = $category->sectionPhotogaleryImgs;
        
        return $this->render('category',[
                                            'section'  => $this->section,
                                            'category'  => $category,
                                            'pics'  => $pics,
            
                                ]);
    }
    
    public function actionPic($alias = null)
    {
        $pic = SectionPhotogaleryImg::getPageFromAlias($alias);
        
        $category = $pic->category;
        
        return $this->render('pic',[
                                            'section'  => $this->section,
                                            'category' => $category,
                                            'pic'      => $pic,
            
                                ]);
    }
}

