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

?>

<h1 class="p2"><?= strip_tags(trim($section->h1)); ?></h1>
<div class="">
    <h3 class="form-title">Напишите свое сообщене...</h3>
    <p class="required_notification">* Обязательные для заполнения поля</p>
    <div class="gbformbox">
        <?= $this->render('form',['gbForm'  => $gbForm]) ?>
    </div>
    
    <!--new style-->
    <ul id="messageList">
        <!--первое сообщение-->
        <li class="message">
            <div class="messageBox">
                <div class="leftPart">
                    <div class="mesHeader">
                        <p class="gb-mesTheme">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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
                <div class="rightPart">
                    <div class="gb-avatarbBox">
                        <?php echo Html::img('@avatar-img-web/default.png', ['alt' => '', 'class' => 'gb-avatarImg gb-avatarImgDefault']); ?>
                    </div>
                    <ul class="gb-userData">
                        <li class="gb-userLogin">Василий</li>
                        <li class="gb-userRole"><i>Гость</i></li>
                        <li class="gb-userCity">Харьков</li>
                    </ul>
                    
                    
                </div>
            </div>
            <!--дочерний стиль.-->
            <ul class="children">
                <li class="message">
                    <div class="messageBox">
                
                    </div>
                </li>
            </ul>
        </li>
        
        <!--второе сообщение-->
        <li class="message">
            <div class="messageBox">
                <div class="leftPart">
                    <div class="mesHeader">
                        <p class="gb-mesTheme">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Ремонт ванной
                        </p>
                        <p class="gb-mesData">
                            <span class="gb-mesAuthorName">Василий</span>
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            <span class="gb-mesDateTime">2016.08.31, 16:46 </span>
                        </p>
                    </div>
                    <div class="mesContent">
                        Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой.Все говорят, что нужно кем-то мне становиться. А я бы хотел остаться собой. 
                    </div>
                </div>
                <div class="rightPart">
                    <div class="gb-avatarbBox">
                        <?php echo Html::img('@avatar-img-web/default.png', ['alt' => '', 'class' => 'gb-avatarImg gb-avatarImgDefault']); ?>
                    </div>
                    <ul class="gb-userData">
                        <li class="gb-userLogin">Василий</li>
                        <li class="gb-userRole"><i>Гость</i></li>
                        <li class="gb-userCity">Харьков</li>
                    </ul>
                    
                    
                </div>
            </div>
            <!--дочерний стиль.-->
            <ul class="children">
                <li class="message">
                    <div class="messageBox">
                
                    </div>
                </li>
            </ul>
        </li>
        
    </ul>
    
   
    
    <!--new style-->
    
    <div class="block-message">
        <div>
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
                    <a href="">Ответить</a>
                    <a href="">Изменить</a>
                    <a href="">Удалить</a>
                    <a href="">Деактивировать</a>
                    
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
                    <?php echo Html::img('@avatar-img-web/default.png', ['alt' => '', 'class' => 'img-gb-default']); ?>
                </div>
                
                
                <ul class="gb-user-data">
                    <li class="user-login">Василий</li>
                    <li class="user-role"><i>Гость</i></li>
                    <li class="user-city">Харьков</li>
                </ul>
            </div>
            
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
                    <?php echo Html::img('@avatar-img-web/default.png', ['alt' => '', 'class' => 'img-gb-default']); ?>
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
                    <?php echo Html::img('@avatar-img-web/default.png', ['alt' => '', 'class' => 'img-gb-default']); ?>
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

