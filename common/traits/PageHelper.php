<?php

namespace common\traits;

use Yii;
use yii\data\Pagination;

trait PageHelper
{

    public static function buildMetaTags($title, $description=null, $keywords=null, $pageNum=null)
    {
        //передаем тайтл
        if(isset($title) && NULL !== $title)
        {
            Yii::$app->view->title = $title.' | '.Yii::$app->name;
            Yii::$app->view->title .= (isset($pageNum) && NULL != $pageNum) ? ' - страница '.$pageNum : '';
        }
        if(isset($description) && NULL !== $description)
        {
            $description .= (isset($pageNum) && NULL != $pageNum) ? " (стр.-{$pageNum})" : '';
            \Yii::$app->view->registerMetaTag(['name' => 'description','content' => $description]);
        }
        if(isset($keywords) && NULL !== $keywords)
        {
            \Yii::$app->view->registerMetaTag(['name' => 'keywords','content' => $keywords]);
        }
    
    }
    
    public static function buildPagination(\yii\db\ActiveQuery $query, $pageSize, $pageNum, $redirectFromNum1)
    {
        $cloneQuery = clone $query;
        $totalCount = $cloneQuery->count();
        $countPagin = ceil($totalCount / $pageSize);//Количество страниц пагинации = все страницы / заданное число материалов на странице
        
        //если введена еденица, делаем редирект на без 1
        if($pageNum == 1)
        {
            return $this->redirect($redirectFromNum1);
        }
        
        //если в адресной строке введен номер пагинации, котрого нет - выводим
        if($pageNum > $countPagin)
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        }
        
        $pagination = new Pagination([  'defaultPageSize' => $pageSize,//кол-во материалов на стр.
                                        'totalCount' => $totalCount,//кол-во всех постов
                                        'pageParam' => 'pageNum',
                                        'forcePageParam' => false,
                            ]);
        $paginContent = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        
        //собираем возвращаемые переменные в массив, в контроллере разбиваем возвращаемый
        //результат так - list($pagination, $paginCategories) = static::buildPagination($query, $this->_pageSize, $pageNum, $redirectFromNum1);
        return [$pagination, $paginContent, $totalCount];
    
    }

}

