<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;


//Активация кнопки обновления капчи.
$script = <<< JS
////////////////////////////////////////////////////////////////////////////////
////////////////////////////captcha actions/////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////    
 $( "#refresh_captcha" ).on( "click", function(event) {
        event.preventDefault();
        $("#my-captcha-image").yiiCaptcha('refresh');
});       
 
$('#my-captcha-image').trigger('click'); 
//captcha actions :end    


////////////////////////////////////////////////////////////////////////////////
////////////////////////////form select tags actions////////////////////////////
////////////////////////////////////////////////////////////////////////////////   

let selectList = $('select.selectList');
let selectListOptions = selectList.children('option');
let parentBlock =  selectList.parent();      
        
selectListOptions.on('mousedown',(function(e) {
    e.preventDefault();
    $(this).prop('selected', !$(this).prop('selected'));
    $( 'select.selectList' ).trigger('change');
    return false;

   })
); 
 
//отрисовка тегов под формой select        
selectList.change(function() {
    let str = [];
     
    if(parentBlock.children('#tagsBoxForm').length == 0 ) {    
        parentBlock
            .append('<div id="tagsBoxForm"></div>');
        
    }    
        
    $(this)
        .children()
        .filter(':selected')
        .each(function() {
                str.push( $(this).text() );
                $('#tagsBoxForm').empty();
            
                jQuery.each(str, function(key, value) {
                    $("<span>")
                            .appendTo($('#tagsBoxForm'))
                            .text(value)
                            //.hide()
                            //.fadeIn('slow')
                            .animate({opacity: 1}, 100);
                });
        
        });
    
    if(str.length == 0){
        $('#tagsBoxForm').empty();
    }    
    //console.log(str);
      
    
   
    
});
        
 
        
 //form select tags actions :end       
        
       
JS;
$this->registerJs($script, yii\web\View::POS_READY);
//var_dump(Yii::$app->user->id);
?>


<?php $form = ActiveForm::begin([
    'id' => 'gb-form',
//    'validateOnBlur' => false,
    'action' => Url::to(['guest-book/index']),
    'options'=>[
//        'autocomplete'=>'off',
        'method' => 'post', 
    ],

//            'enableAjaxValidation'   => true,
//            'enableClientValidation' => false,
    'fieldConfig' => [
        'template' => 
        "{hint}"
        ."<div class='clearfix'></div>"
        ."{label}"
        ."<div class='col-md-16'>"
        ."<span class='marker'></span>"
        . "{input}"
        ."<p class='help-block'>{error}</p>"
        . "</div>",

        'options' => [

            'tag' => 'div',
            'class' => 'formgroup row',

        ],
        'hintOptions' => [
                'class' => 'hint-block col-md-8',
                'tag' => 'div',
        ],
        'errorOptions' => [
                'class' => 'help-message',
                'tag' => 'span',
        ],
        'labelOptions' => [
                'class' => 'label-control col-md-8',
                
        ],
        'inputOptions' => [
                'class' => 'gb--text-input',
                
        ],
    ],

]); ?>

<?= (Yii::$app->user->isGuest === false) ? : $form->field($gbForm, 'visitor_name')->textInput(['placeholder' => $gbForm->getAttributePlaceholder( 'visitor_name' ), 'maxlength' => 255])->hint('Напишите Ваше имя') 
//            ->label($gbForm->getattributeLabel( 'visitor_name' ).' :')    
        ?>

<?= $form->field($gbForm, 'visitor_city')->textInput(['placeholder' => $gbForm->getAttributePlaceholder( 'visitor_city' ), 'maxlength' => 255])->hint('Напишите из какого Вы города') ?>

<?php //echo $form->field($gbForm, 'subject')->textInput(['placeholder' => $gbForm->getAttributePlaceholder( 'subject' ), 'maxlength' => 255])->hint('Напишите краткую тему сообщения') ?>

<?= $form->field($gbForm, 'tags')
        //->textInput()
        ->dropDownList($gbForm->dropdownListTags,['multiple' => true,'class' => 'selectList','size' => 4])
        ->hint('Выберите ключевые слова сообщения') ?>


<?= $form->field($gbForm, 'message')->textarea(['placeholder' => $gbForm->getAttributePlaceholder( 'message' ), 'class' => 'gb--textarea'])->hint('Напишите ваше сообщение') ?>

<?php //echo $form->errorSummary($gbForm); ?>

<?= $form->field($gbForm, 'captcha')->widget(Captcha::className(),[
                            'captchaAction'=>'guest-book/captcha',//and in urlManager 'gb/captcha' => 'guest-book/captcha',
                            'template' => "<div class='image_code'>{image}<a href=\"javascript:;\" id=\"refresh_captcha\">Обновить картинку</a></div>{input}",
                            'imageOptions' => [
                                'id' => 'my-captcha-image'
                            ],
                            'options' => ['class' => 'my-captcha-input'],
    ])->hint('Введите цифры с картинки') ?>

<?php echo $form->field($gbForm, 'parent_id', ['template' => '{input}'])->hiddenInput(['id' => 'gbHiddenInputParentId', 'value' => 0]); ?>

<div class="form-group">
    <?= Html::submitButton('Опубликовать', ['class' => 'submit']) ?>
</div>

<?php ActiveForm::end(); ?>