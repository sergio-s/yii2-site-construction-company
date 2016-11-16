<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use yii\widgets\LinkPager;//для пагинации

\frontend\assets\ColorboxAsset::register($this);

$this->params['breadcrumbs'][] = array('label'=> strip_tags(trim($section->h1)), 'url'=> Url::toRoute(['photo/index'], true));
$this->params['breadcrumbs'][] = strip_tags(trim($category->h1));
$i = 1;
?>
<div class="indent-left p2">
    <h1 class="p2 margin-center"><?= strip_tags(trim($category->h1)); ?></h1>

</div>

<div class="row">
    <div class="col-md-24">
        <div class="row">
            <div class="col-md-6">
                <?php echo Html::img('@photogalery-web/categories/' .$category->id.'/thumb/'. $category->imgSrc, ['alt' => $category->h1, 'class' => 'img-radius-100 box-shedow-pics']); ?>
                <span class="price liteGrin">30 фото</span>
            </div>
            <div class="col-md-18">
                <div class="textStyle2">
                    <em><?=$category->description;?></em>
                </div>
                <ul class="tags">
                    <li><a href="">укладка плитки</a></li>
                    <li><a href="">электрика</a></li>
                    <li><a href="">сантехника</a></li>
                    <li><a href="">ремонт комнаты</a></li>
                </ul>
            </div>    
        </div>    
    </div>

</div>
<br>
<div class="row categories_galery">
    
    <?php foreach($pics as $pic):?>

        <article class="col-md-8 p2-2">
            <figure class="frame2 p1 hover-border ">
                <?php if (isset($pic->imgSrc)): ?>
                    <a rel="group1" title="<?= $pic->title; ?>" href="<?= Yii::getAlias('@photogalery-web/photos/big/'. $pic->imgSrc); ?>" class="imgColorBox a-block ">
                        <?php echo Html::img('@photogalery-web/photos/thumbnail/' . $pic->imgSrc, ['alt' => $pic->h1, 'style' => 'width:100%; height: auto']); ?>
                        <span class='bigger'><i class="fa fa-search" aria-hidden="true"></i></span>
                    </a>    
                <?php endif; ?>
            </figure>
            <div>
                <p class="p1" style="text-align: center;min-height: 60px;">
                    <small ><?php echo BaseStringHelper::truncateWords(strip_tags($pic->h1), 8, $suffix = '...' );?></small>
                </p>
                
                <p>
                    <a class="textStyle2 btn-3" href="<?=Url::toRoute(['photo/pic', 'alias' => $pic->alias]);?>"><i class="fa fa-eye iconAlign" aria-hidden="true"></i><span>Детали фото...</span></a>
                </p>    
            </div>
            <!--<p><?php //echo BaseStringHelper::truncate(strip_tags($pic->description), 100, $suffix = '...' );?></p>-->
                
            
        </article>
        <?php if($i % 4 == 0):?>
            <div class="clear-float"></div>
        <?php endif;?>
        <?php $i++;?>    
    <?php endforeach;?>
</div>





                    