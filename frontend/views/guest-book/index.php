<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use yii\widgets\LinkPager;//для пагинации
use yii\widgets\ActiveForm;


$this->params['breadcrumbs'][] = strip_tags(trim($section->title));

//\frontend\assets\LoupeAsset::register($this);

?>

<h1 class="p2"><?= strip_tags(trim($section->h1)); ?></h1>
<div class="">
    <h3 class="form-title">Напишите свое сообщене...</h3>
    <p class="required_notification">* Обязательные для заполнения поля</p>
    <div class="gbformbox">
        <?php $form = ActiveForm::begin([
            'id' => 'gb-form',
            'fieldConfig' => [
                'template' => "{label}{input}"
                . "<span class='help-block'>"
                . "<i class='fa fa-thumbs-o-up'></i>"
                . "<i class='fa fa-thumbs-o-down'></i>"
                . "{error}"
                . "</span>"
                . "{hint}",
                
                'options' => [
                    'tag' => 'div',
                    'class' => 'formgroup',
                    
                ],
                'hintOptions' => [
                        'class' => 'hint-block',
                        'tag' => 'div',
                ],
                'errorOptions' => [
                        'class' => 'help-message',
                        'tag' => 'span',
                ],
            ],
            
        ]); ?>

        <?= (Yii::$app->user->isGuest === false) ? : $form->field($gbForm, 'visitor_name')->textInput(['placeholder' => $gbForm->getAttributePlaceholder( 'visitor_name' ), 'maxlength' => 255, 'class' => 'shift'])->hint('Напишите Ваше имя') 
//            ->label($gbForm->getattributeLabel( 'visitor_name' ).' :')    
                ?>

        <?= $form->field($gbForm, 'visitor_city')->textInput(['placeholder' => $gbForm->getAttributePlaceholder( 'visitor_city' ), 'maxlength' => 255, 'class' => 'shift'])->hint('Напишите из какого Вы города') ?>
        
        <?= $form->field($gbForm, 'subject')->textInput(['placeholder' => $gbForm->getAttributePlaceholder( 'subject' ), 'maxlength' => 255, 'class' => 'shift'])->hint('Напишите краткую тему сообщения') ?>
        
        <?= $form->field($gbForm, 'message')->textarea(['rows' => 2, 'cols' => 50, 'placeholder' => $gbForm->getAttributePlaceholder( 'message' ), 'class' => 'shift'])->hint('Напишите ваше сообщение') ?>

        <?php //echo $form->errorSummary($gbForm); ?>
        
        <div class="form-group">
            <?= Html::submitButton('Опубликовать', ['class' => 'submit']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        
        
        
    </div>
    
    
    <div class="block-message">
        <div class="col-80">
            <div class="padding-20">
                <div class="l-header">
                    <p class="gb-message-theme">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Ремонт ванной       
                    </p>
                    <ul>   
                        <li class="user-login">Василий</li>
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        <li class="gb-message-time">2016.08.31, 16:46 </li>
                    </ul>    
                </div>
                <div class="r-content">
                    <div class="r-content-question">
                            Все говорят, что нужно кем-то мне становиться.
                        А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                        А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                        А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                        А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                        А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                        А я бы хотел остаться собой.
                    </div>
                    
                </div>
            </div>    
        </div>
        
        <div class="col-20">
            <div class="padding-20 r-block-gb">
                <div class="img-gb-box">
                    <?php echo Html::img('@avatar-img-web/default.jpg', ['alt' => '', 'class' => 'img-gb-default']); ?>
                </div>
                
                
                <ul class="gb-user-data">
                    <li class="user-login">Василий</li>
                    <li class="user-role"><i>Гость</i></li>
                    <li class="user-city">Харьков</li>
                </ul>
            </div>
            
        </div>
        
        <!--ответ админа-->
        <div class="padding-20">
            <div class="answer">
                <div>
                    <div class="col-15">
                        <div class="padding-20">
                            <div class="img-gb-box">
                                <?php echo Html::img('@avatar-img-web/admin/master.jpg', ['alt' => '', 'class' => 'img-gb-admin']); ?>
                            </div>
                            <ul class="gb-user-data">
                                <li class="user-login" style="color:green;text-align: center;">Мастер</li>
    <!--                                    <li class="user-role"><i>Мастер</i></li>-->

                            </ul>
                        </div>

                    </div>

                    <div class="col-85">
                        <div class="padding-20">
                            <div class="l-header">
                                <ul>   
                                    <li style="color:green;"><i>Ответ мастера</i></li>
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    <li class="gb-message-time">2016.08.31, 16:46 </li>
                                </ul>    
                            </div>
                            <div class="r-content">
                                <div class="r-content-question">
                                    Все говорят, что нужно кем-то мне становиться.
                                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                                    А я бы хотел остаться собой.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--ответ админа-->    
        
    </div>
    
        <div class="block-message">
        <div class="col-80">
            <div class="padding-20">
                <div class="l-header">
                    <p class="gb-message-theme">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Ремонт ванной       
                    </p>
                    <ul>   
                        <li class="user-login">Василий</li>
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        <li class="gb-message-time">2016.08.31, 16:46 </li>
                    </ul>    
                </div>
                <div class="r-content">
                    Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.
                </div>
            </div>    
        </div>
        
        <div class="col-20">
            <div class="padding-20 r-block-gb">
                <div class="img-gb-box">
                    <?php echo Html::img('@avatar-img-web/default.jpg', ['alt' => '', 'class' => 'img-gb-default']); ?>
                </div>
                
                
                <ul class="gb-user-data">
                    <li class="user-login">Василий</li>
                    <li class="user-role"><i>Гость</i></li>
                    <li class="user-city">Харьков</li>
                </ul>
            </div>
            
        </div>
    </div>
    
    
            <div class="block-message">
        <div class="col-80">
            <div class="padding-20">
                <div class="l-header">
                    <p class="gb-message-theme">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Ремонт ванной       
                    </p>
                    <ul>   
                        <li class="user-login">Василий</li>
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        <li class="gb-message-time">2016.08.31, 16:46 </li>
                    </ul>    
                </div>
                <div class="r-content">
                    Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться.
                    А я бы хотел остаться собой.
                </div>
            </div>    
        </div>
        
        <div class="col-20">
            <div class="padding-20 r-block-gb">
                <div class="img-gb-box">
                    <?php echo Html::img('@avatar-img-web/default.jpg', ['alt' => '', 'class' => 'img-gb-default']); ?>
                </div>
                
                
                <ul class="gb-user-data">
                    <li class="user-login">Василий</li>
                    <li class="user-role"><i>Гость</i></li>
                    <li class="user-city">Харьков</li>
                </ul>
            </div>
            
        </div>
    </div>
    
</div>