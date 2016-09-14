<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

//Активация кнопки обновления капчи.
$script = <<< JS
        
 $( "#refresh_captcha" ).on( "click", function(event) {
        event.preventDefault();
        $("#my-captcha-image").yiiCaptcha('refresh');
});       
            
//$('#my-captcha-image').trigger('click');        
JS;
$this->registerJs($script, yii\web\View::POS_READY);

?>

<?php $form = ActiveForm::begin([
    'id' => 'gb-form',
//    'validateOnBlur' => false,
    'action' => Url::to(['guest-book/form']),
    'options'=>[
        'autocomplete'=>'off',
        'method' => 'post', 
    ],

//            'enableAjaxValidation'   => true,
//            'enableClientValidation' => false,
    'fieldConfig' => [
        'template' => "{label}"
        . "<div class='input-box'>"
        . "{input}"
        . "<span class='help-block'>"
        . "<i class='fa fa-thumbs-o-up'></i>"
        . "<i class='fa fa-thumbs-o-down'></i>"
        . "{error}"
        . "</span>"
        . "</div>"
        . "<div style=\"clear:both;\"></div>"
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

<?= $form->field($gbForm, 'message')->textarea([ 'placeholder' => $gbForm->getAttributePlaceholder( 'message' ), 'class' => 'shift'])->hint('Напишите ваше сообщение') ?>

<?php //echo $form->errorSummary($gbForm); ?>

<?= $form->field($gbForm, 'captcha')->widget(Captcha::className(),[
                            'captchaAction'=>'guest-book/captcha',//and in urlManager 'gb/captcha' => 'guest-book/captcha',
                            'template' => "<div class='image_code'>{image}<a href=\"javascript:;\" id=\"refresh_captcha\">Обновить картинку</a></div>{input}",
                            'imageOptions' => [
                                'id' => 'my-captcha-image'
                            ],
                            'options' => ['class' => 'my-captcha-input'],
    ])->hint('Введите цифры с картинки') ?>

<div class="form-group">
    <?= Html::submitButton('Опубликовать', ['class' => 'submit']) ?>
</div>

<?php ActiveForm::end(); ?>