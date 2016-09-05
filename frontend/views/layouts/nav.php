<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

$menu = [
    Url::home(true) => 'Про мастеров',
    Url::toRoute(['page/normal', 'alias' => 'price'], true) => 'Прайс',
    Url::toRoute(['photo/index'], true) => 'Фото работ',
    Url::toRoute(['guest-book/index'], true) => 'Вопросы мастеру',
    Url::toRoute(['page/normal', 'alias' => 'contacts'], true) => 'Контакты',
];
$currentRoute = Yii::$app->controller->route;

?>

<nav>
    <ul class="menu">
    <?php foreach($menu as $url => $name):?>
        <?php if($url === Url::current([],true) or ($url === Url::toRoute([$currentRoute], true) && $name === 'Фото работ') ):?>
        
            <li><a class="active" href="<?= $url; ?>"><?= $name; ?></a></li>
            
        <?php else:?>
            
            <li><a href="<?= $url; ?>"><?= $name; ?></a></li>
            
        <?php endif;?>
    <?php endforeach;?>    
    </ul>
</nav>