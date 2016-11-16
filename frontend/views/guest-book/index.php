<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use yii\widgets\LinkPager;//для пагинации
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

\frontend\assets\GuestBookAsset::register($this);

$this->params['breadcrumbs'][] = strip_tags(trim($section->title));

$script = <<< JS
//    $('body').on('mouseenter', '#messageList', function () {
//   alert($("#messageList:last-child").text());
//});    

JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>

<h1 class=""lass="p2"><?= strip_tags(trim($section->h1)); ?></h1>
<div>
    <h3 class="form-title">Напишите свое сообщене...</h3>
    <p class="required_notification asterisk">Обязательные для заполнения поля</p>
    <div class="gbformbox">
        <?= $this->render('_form',compact('gbForm')) ?>
    </div>
    
    <ul id="gb-messageList" class="container-fluid">
        <?= $this->render('_comments',compact('messagesTree', 'nestingLevel')) ?>
    </ul>    
        
        
<!--        <li class="gb-message">
            <div class="gb-message-box">
                
                left part
                <div class="gb-message-box-left">
                    <div class="mesHeader p2">
                        <p class="gb-mesTheme">
                            <i class="fa fa-pencil-square-o yellowOrange" aria-hidden="true"></i>
                            <span>Ремонт ванной</span>
                        </p>
                        <p class="gb-mesData">
                            <span class="gb-mesAuthorName">Василий</span>
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            <span class="gb-mesDateTime">2016.08.31, 16:46 </span>
                        </p>
                        <ul class="gb-adminLinks">
                            <li><a href="">Ответить</a></li>
                            <li><a href="">Изменить</a></li>
                            <li><a href="">Удалить</a></li>
                            <li><a href="">Деактивировать</a></li>
                        </ul>
                    </div>
                    <div class="mesContent">
                        Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой. Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой. Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой. Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой. 
                    </div>
                </div>
                
                right part
                <div class="gb-message-box-right">
                    <div class="gb-avatarbBox">
                        <?php echo Html::img('@avatar-img-web/default.png', ['alt' => '', 'class' => 'gb-avatarImg img-respons']); ?>
                    </div>
                    <ul class="gb-userData">
                        <li class="gb-userLogin">Василий</li>
                        <li class="gb-userRole"><i>Гость</i></li>
                        <li class="gb-userCity">Харьков</li>
                    </ul>
                </div>
            </div>
            
            ответ админа
            <ul class="gb-answer cloud">
                <li>
                    <div class="gb-answer-box">
                        <div class="gb-answer-box-left">
                            <div class="gb-avatarbBox">
                                <?php echo Html::img('@avatar-img-web/master.jpg', ['alt' => '', 'class' => 'img-gb-admin img-respons']); ?>
                            </div>
                            <ul class="gb-userData">
                                <li class="gb-userLogin" style="color:green;text-align: center;">Мастер</li>
                                <li class="gb-userRole" style="text-align: center;"><i>Админ</i></li>
                            </ul>
                        </div>
                        <div class="gb-answer-box-right">
                            <div class="mesHeader p2">
                                <p class="gb-mesData">
                                    <span class="gb-mesAuthorName">Ответ мастера</span>
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    <span class="gb-mesDateTime">2016.08.31, 16:46 </span>
                                </p>
                                <ul class="gb-adminLinks">
                                    <li><a href="">Изменить</a></li>
                                    <li><a href="">Удалить</a></li>
                                    <li><a href="">Деактивировать</a></li>
                                </ul>
                            </div>
                            <div class="answerContent">
                                Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой. Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой. Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой. Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой. 
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </li>-->
      
  
    
</div>

<div class="pagination-box">
            <?= LinkPager::widget([
                'pagination' => $pagination, 
                'hideOnSinglePage' => true,
                'prevPageLabel' => '&laquo; назад',
                'nextPageLabel' => 'далее &raquo;',
                ]) ?>
</div>