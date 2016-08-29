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

<div class="indent-left p2">
    <h1 class="p2 margin-center"><?= strip_tags(trim($section->h1)); ?></h1>

</div>

<div class="wrapper p4 categories_galery">
    <?php foreach($paginCategories as $category):?>

        <article class="grid_4 alpha">
            <div class="indent-left">
                <figure class="frame2 p2">
                        <?php if (isset($category->imgSrc)): ?>
                            <?php echo Html::img('@photogalery-web/categories/' .$category->id.'/'. $category->imgSrc, ['alt' => $category->h1, 'style' => 'width:250px; height: 127px']); ?>
                        <?php endif; ?>
                </figure>
                <p class="color-4 prev-indent-bot"><a href="<?=Url::toRoute(['photo/category', 'alias' => $category->alias]);?>"><?=$category->h1;?></a></p>
                <p><?=BaseStringHelper::truncate(strip_tags($category->description), 100, $suffix = '...' );?></p>
                <div class="wrapper">
                    <span class="price fleft">20 фото</span>
                    <a class="button fright" href="<?=Url::toRoute(['photo/category', 'alias' => $category->alias]);?>">Подробнее</a>
                </div>
            </div>
        </article>
    
    <?php endforeach;?>
</div>

    
    


<div class="pagination-box">
            <?= LinkPager::widget(['pagination' => $pagination, 'hideOnSinglePage' => true]) ?>
</div>



                    