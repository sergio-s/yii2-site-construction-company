<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\helpers\BaseStringHelper;
use common\components\rbac\rbacRoles;
?>

<?php 
//var_dump(Yii::$app->user->identity);
?>
<?php if ($messagesTree) : ?>
    <?php foreach ($messagesTree as $message) : ?>
        <?php if ($message->isActive): ?><!--если статус сообщения - активно-->
            <li class="row gb-singleList">
                <div class="gb-avatarbBox col-md-3">
                    <div>
                        <?=$message->avatar;?>
                    </div>
                    <?php if($message->isReplied()):?>
                    <span class="repliedCount" title="Кол-во ответов на сообщение."><i class="fa fa-reply" aria-hidden="true"></i><?=$message->isReplied();?></span>
                    <?php endif;?>
                </div>
                <div class="gb-message  col-md-21">
                    <div class="gb-message-box">
                        <div class="mesHeader">
                            <ul class="gb-mesData">
                                <li><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                    <span class="gb-h-author"><strong>Автор:</strong>
                                    <?php if ($message->isAuthorRegistered): ?>
                                        <em><?=$message->author->username;?></em>
                                        <sup>(<?=$message->author->role;?>)</sup>
                                    <?php else:?>
                                        <em><?=$message->visitor_name;?></em>
                                        <sup>(<?=$message->printVisitorType($message->visitor_type);?>)</sup>
                                    <?php endif;?>
                                    </span>
                                </li>
                                <li class="gb-angle"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
                                <li><span><i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <strong>Дата сообщения:</strong><em><?=$message->getCreatedDate();?> в <?=$message->getCreatedTime();?></em>
                                    </span>
                                </li>
                            </ul>
                            <?php if($message->hasTags()):?>
                            <ul class="gb-tags">
                                <li><span><i class="fa fa-tags" aria-hidden="true"></i><strong>Теги:</strong></span></li>
                                <?php foreach($message->tags as $tag):?>
                                <li><a href=""><?=$tag->tag;?></a></li>
                                <?php endforeach;?>
                            </ul>
                            <?php endif;?>
                            <?php if(!Yii::$app->user->isGuest):?><!--Если зарегестрирован -->
                            <ul class="gb-actions">
                                <li class="gb-action-answer"><a href="">Ответить</a></li>
                                <?php if (Yii::$app->getUser()->can(rbacRoles::ROLE_ADMIN)): ?><!--Если админ -->
                                <li class="gb-action-update"><a href="">Изменить</a></li>
                                <li class="gb-action-disabled"><a href="">Деактивировать</a></li>
                                <li class="gb-action-delete"><a href="">Удалить</a></li>
                                <?php endif;?>
                            </ul>
                            <?php endif;?>
                        </div>
                        <div class="gb-text">
                            <?=$message->message;?>
                        </div>
                    </div>
                </div>

                <?php if ($message->hasChildren()): ?>
                <?php  
                //var_dump($message);die;
                ?>
                    <div class="gb-chMesWrap"><!-- dother messages -->
                        <ul class="gb-childrenMessage container-fluid">
                            <?= $this->render('_comments',['messagesTree' => $message->childMessages,'nestingLevel' => $nestingLevel]) ?>
                        </ul>
                    </div><!-- end: dother messages -->
                <?php endif; ?>
                        
            </li>

        <?php endif; ?>

    <?php endforeach; ?>

<?php else: ?>

    <li><i>Сообщений пока нет... Будьте первым!</i></li>

<?php endif; ?>

    
    <!--<li class="row gb-singleList gb-adminMes">-->