<?php

namespace frontend\controllers\page;

use Yii;
use app\models\page\SectionPage;

/* 
 * PageService
 */

class PageService
{
    const HOME_PAGE = 1;
    const NORMAL_PAGE = 0;
    
    private $page;
    
    /**
     * @return type
     */
    public function __construct($flag, $alias = false) {
        $this->setPage($flag, $alias);
    }
    
    
    public function setPage($flag, $alias)
    {
        if($flag === self::HOME_PAGE){
            $this->page = SectionPage::getHomePage();
        }elseif($flag === self::NORMAL_PAGE && false !== $alias){
            $this->page = SectionPage::getPageFromAlias($alias);
        }else{
            throw new \yii\web\MethodNotAllowedHttpException("Flag {$flag} not allowed or alias is false");
        }
    }
   
    public function getPage()
    {
        if($this->issetPage()){
            $this->registerMetaTags();
            return $this->page;
        }else{
            return false;
        }
            
    }        

    private function issetPage()
    {
        if($this->page === NULL)
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
            //throw new \yii\web\NotFoundHttpException;
        }
        return true;
    }
    
    public function registerMetaTags()
    {
        //передаем тайтл
        if($this->page->title)
        {
            Yii::$app->view->title = $this->page->title.'|'.Yii::$app->name;
        }
        if(isset($this->page->description) && NULL !== $this->page->description)
        {
            \Yii::$app->view->registerMetaTag(['name' => 'description','content' => $this->page->description]);
        }
        if(isset($this->page->keywords) && NULL !== $this->page->keywords)
        {
            \Yii::$app->view->registerMetaTag(['name' => 'keywords','content' => $this->page->keywords]);
        }
    }
    
    
}