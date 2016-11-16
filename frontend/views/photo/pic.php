<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use yii\widgets\LinkPager;//для пагинации



$this->params['breadcrumbs'][] = array('label'=> strip_tags(trim($section->h1)), 'url'=> Url::toRoute(['photo/index'], true));
$this->params['breadcrumbs'][] = array('label'=> strip_tags(trim($category->h1)), 'url'=> Url::toRoute(['photo/category', 'alias' => $category->alias]));
$this->params['breadcrumbs'][] = strip_tags(trim($pic->h1));



\frontend\assets\LoupeAsset::register($this);

?>

<h1 class="p2"><?= strip_tags(trim($pic->h1)); ?></h1>
<div>

    <h6 class="p2"><?= $pic->description; ?></h6>

    <figure class="frame2 p2">

        <!--loupe-->
        <a class="loupe" href="<?= Yii::getAlias('@photogalery-web/photos/origin/' . $pic->imgSrc); ?>">
            <?php echo Html::img('@photogalery-web/photos/middle/' . $pic->imgSrc, ['alt' => $pic->h1, 'style' => 'width:100%;', 'class' => 'zoom']); ?>
        </a>

    
    </figure>

    <div class="">
        <?= $pic->content; ?>
    </div>
    



</div>