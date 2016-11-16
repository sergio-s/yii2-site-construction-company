<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\IE9Asset;
use frontend\assets\InitTempScripts;
use common\widgets\Alert;

AppAsset::register($this);
//IE9Asset::register($this);
InitTempScripts::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <?php $this->head() ?>
    
</head>
<body>
<?php $this->beginBody() ?>
    
<!--==============================header=================================-->
    <header>
    	<div class="row-1">
            <div class="main">
            	<div class="container_12">
                    <div class="grid_12">
                    	
                        <?= $this->render('nav') ?>
                        
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row-2">
        	<div class="main">
            	<div class="container_12">
                    <div class="grid_9">
                    	<div class="logoBox">
                            <span>Сайт</span>
                            <a class="logo" href="index.html">Мас<strong>е</strong>ров</a>
                            <small class="slogan">Мастера по ремонтам квартир в Харькове</small>
                        </div>
                                
                    </div>
                    <div class="grid_3">
                    	<form id="search-form" method="post" enctype="multipart/form-data">
                            <fieldset>	
                                <div class="search-field">
                                    <input name="search" type="text" />
                                    <a class="search-button" href="#" onClick="document.getElementById('search-form').submit()"><span>search</span></a>	
                                </div>						
                            </fieldset>
                        </form>
                     </div>
                     <div class="clear"></div>
                </div>
            </div>
        </div>    	
    </header><div class="ic">More Website Templates  @ TemplateMonster.com - August22nd 2011!</div>
    
<!-- content -->
    <section id="content">
        <div class="bg-top">
            <div class="bg-top-2">
                <div class="bg">
                    <div class="bg-top-shadow">
                        <div class="main">
                            <div class="box p3">
                                <div class="padding">
                                    <div class="container_12">
                                        <div class="wrapper">
                                            <div class="grid_12">
                                                <!--хлебный крошки-->
                                                <?= Breadcrumbs::widget([
                                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                                    'options'=> ['id' => 'breadcrumbs-one'],
                                                    'activeItemTemplate' => "<li><span class=\"current\">{link}</span></li>\n",
                                                    ]);
                                                ?>
                                            
                                                
                                                <div id="relativeContent" class="wrapper">
                            
                                                <?= $content ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container_12">
                                <div class="wrapper">
                                    <article class="grid_4">
                                        <h3 class="color-1 p2">Consultation</h3>
                                        <span class="text-1">Lorem ipsum dolor sit amet, con sectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua enim <br>ad minim veniam.</span>
                                    </article>
                                    <article class="grid_4">
                                        <h3 class="color-1 p2">Our Mission</h3>
                                        <span class="text-1">Duis aute irure dolor in reprehen derit in voluptate velit esse cillum dolore eu fugiat nulla xcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</span>
                                    </article>
                                    <article class="grid_4">
                                        <h3 class="color-1 indent-bot">Consultation</h3>
                                        <form id="subscribe-form" method="post" enctype="multipart/form-data">                    
                                            <fieldset>
                                                <div class="subscribe-field">
                                                    <input type="text" />
                                                </div>
                                                <a class="button" href="#" onClick="document.getElementById('subscribe-form').submit()">Subscribe</a>        
                                            </fieldset>						
                                        </form>
                                    </article>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>	
        </div>    
        
        
        <div class="bg-bot">
            <div class="main">
                <div class="container_12">
                        <div class="wrapper">
                        <article class="grid_4">
                                <div class="indent-right2">
                                <h3 class="prev-indent-bot2">Space Planning</h3>
                                <ul class="list-2">
                                    <li><a href="#">Totam rem aperiam eaque ipsa quae abillo</a></li>
                                    <li><a href="#">Inventore veritatis quasi architecto beatae vitae</a></li>
                                    <li><a href="#">Nemo enim ipsam voluptatem quia</a></li>
                                    <li><a href="#">Voluptas sit aspernatur aut odit aut fugit</a></li>
                                    <li class="last-item"><a href="#">Sed quia consequuntur magni dolores eos</a></li>
                                </ul>
                            </div>
                        </article>
                        <article class="grid_8">
                                <h3 class="p2">Selection &amp; Installation</h3>
                            <div class="wrapper">
                                <figure class="img-indent2 frame2"><?php echo Html::img('@css-img-web/page2-img2.jpg', ['alt'=>'', 'class'=>'']);?></figure>
                                <div class="extra-wrap">
                                        <h6 class="p1">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias.</h6>
                                    Excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctioam libero tempore cum soluta.
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    
	<!--==============================footer=================================-->
    <footer>
        <div class="main">
        	<div class="container_12">
            	<div class="wrapper">
                	<div class="grid_4">
                    	<div>Interior Design &copy; 2011 <a class="link color-3" href="#">Privacy Policy</a></div>
                        <div><a rel="nofollow" target="_blank" href="http://www.templatemonster.com/">Website Template</a> by TemplateMonster.com | <a rel="nofollow" target="_blank" href="http://www.html5xcss3.com/">html5xcss3.com</a></div>
                        <!-- {%FOOTER_LINK} -->
                    </div>
                    <div class="grid_4">
                    	<span class="phone-numb"><span>+1(800)</span> 123-1234</span>
                    </div>
                    <div class="grid_4">
                    	<ul class="list-services">
                        	<li><a href="#"></a></li>
                            <li><a class="item-2" href="#"></a></li>
                            <li><a class="item-3" href="#"></a></li>
                            <li><a class="item-4" href="#"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
