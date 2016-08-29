<?php
namespace frontend\controllers\page;

use Yii;
use yii\helpers\Url;
use frontend\controllers\BaseFront;
use app\models\page\SectionPage;
/**
 * PageController
 */
class PageController extends BaseFront
{
    /**
     * Print home page.
     */
    public function actionHome()
    {
        $service = new PageService(PageService::HOME_PAGE);
        $homePage = $service->getPage();
        
        return $this->render('home',[
                                        'h1'          => $homePage->h1,
                                        'description' => $homePage->description,
                                        'content'     => $homePage->content,
                                ]);
    }
    
    /**
     * Print normal page.
     * Возвращает обычную страницу.
     * @param string $alias
     */
    public function actionNormal($alias)
    {
        $service = new PageService(PageService::NORMAL_PAGE, $alias);
        $page = $service->getPage();
//        print_r($page);die;    
        
        return $this->render('normal',[
                                        'h1'          => $page->h1,
                                        'description' => $page->description,
                                        'content'     => $page->content,
                                ]);
    }
    
    
}

