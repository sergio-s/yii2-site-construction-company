<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use yii\widgets\LinkPager;//для пагинации

$this->params['breadcrumbs'][] = strip_tags(trim($section->h1));

?>

<div class="pagination-box">
            <?= LinkPager::widget(['pagination' => $pagination, 'hideOnSinglePage' => true]) ?>
</div>

<h1 class="p2"><?= strip_tags(trim($section->h1)); ?></h1>



<div class="row categories_galery">
    <?php foreach($paginCategories as $category):?>

        <article class="col-md-12 p2">
            <figure class="frame2 p2 link-img">
                    <?php if (isset($category->imgSrc)): ?>
                        <a class="" href="<?= Url::toRoute(['photo/category', 'alias' => $category->alias]); ?>">
                            <?php echo Html::img('@photogalery-web/categories/' . $category->id . '/' . $category->imgSrc, ['alt' => $category->h1, 'class' => 'img-respons']); ?>
                        </a>
                    <?php endif; ?>
            </figure>
            <p class="color-4 prev-indent-bot"><a href="<?=Url::toRoute(['photo/category', 'alias' => $category->alias]);?>"><?=$category->h1;?></a></p>
            <p><?=BaseStringHelper::truncate(strip_tags($category->description), 100, $suffix = '...' );?></p>
            <div class="wrapper">
                <span class="price fleft liteGrin">20 фото</span>
                <a class="btn-2 fright" href="<?=Url::toRoute(['photo/category', 'alias' => $category->alias]);?>">Подробнее</a>
            </div>
            
        </article>
    
    <?php endforeach;?>
   
</div>

    
    


<div class="pagination-box">
            <?= LinkPager::widget(['pagination' => $pagination, 'hideOnSinglePage' => true]) ?>
</div>



                    