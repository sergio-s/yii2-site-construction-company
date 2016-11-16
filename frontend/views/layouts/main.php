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
    <div class="container-fluid">
            <!--==============================header=================================-->
        <header>
            <div class="row row-1">
                <div class="col-md-20 col-md-offset-2">
                    <?= $this->render('nav') ?>
                </div>
            </div>
            <div class="row row-2">
                <div class="col-md-20 col-md-offset-2">
                    <div class="row">
                        <div class="col-md-14">
                            <div class="logoBox">
                                <span>Сайт</span>
                                <a class="logo" href="index.html">Мас<strong>е</strong>ров</a>
                                <small class="slogan">Мастера по ремонтам квартир в Харькове</small>
                            </div>

                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <form id="search-form" method="post" enctype="multipart/form-data">
                                <fieldset>	
                                    <div class="search-field">
                                        <input name="search" type="text" />
                                        <a class="search-button" href="#" onClick="document.getElementById('search-form').submit()"><span>search</span></a>	
                                    </div>						
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    	
        </header>

    <!-- content -->
        <section id="content" class="row">
            <div class="bg-slise1"></div>
            <div class="bg-slise2"></div>
            <div class="bg-slise3"></div>
            
            <div id="content-center" class="row">
                <?php if(isset($this->params['breadcrumbs'])):?>
                <div id="breadcrumbs-col" class="col-md-22 col-md-offset-1">
                    <!--хлебный крошки-->
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options'=> ['class' => 'breadcrumbs-1'],
                        'activeItemTemplate' => "<li><span class=\"current\">{link}</span></li>\n",
                        'homeLink' => [
                            'label' => Yii::t('yii', 'Home'),
                            'url' => Yii::$app->homeUrl,
                        ],
                ]);
                    ?>
                </div>
                <?php endif;?>
                <div class="col-md-22 col-md-offset-1">
                    
                    <div id="main" class="row">
                        <?= $content ?>
                    </div>
                    
                    
                </div>
            </div>
   
            <div id="content-bottom" class="row content-bottom">
                <div class="col-md-20 col-md-offset-2">
                    <div class="row">
                        <article class="col-md-8">
                            <h3 class="color-1 p2">Consultation</h3>
                            <span class="textStyle3">Lorem ipsum dolor sit amet, con sectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua enim <br>ad minim veniam.</span>
                        </article>
                        <article class="col-md-8">
                            <h3 class="color-1 p2">Our Mission</h3>
                            <span class="textStyle3">Duis aute irure dolor in reprehen derit in voluptate velit esse cillum dolore eu fugiat nulla xcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</span>
                        </article>
                        <article class="col-md-8">
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
        </section>    	


            <!--конец листа-->
    <!--        <div class="bg-bot">
                    <div class="main">
                    <div class="container_12">
                            <div class="wrapper">
                            <article class="grid_4">
                                    <h3 class="prev-indent-bot">About Us</h3>
                                <p class="prev-indent-bot">This <a target="_blank" href="http://blog.templatemonster.com/2011/08/22/free-website-template-clean-style-interior/ ">Interior Design Template</a> goes with two pack ages: with PSD source files and without them.</p>
                                PSD source files are available for free for the registered members of Templates.com. The basic package (without PSD source) is available for anyone without registration.
                            </article>
                            <article class="grid_4">
                                    <h3 class="prev-indent-bot">Testimonials</h3>
                                <div class="quote">
                                    <p class="prev-indent-bot">At vero eos et accusamus et iusto odio tium voluptatum deleniti atque corrupti quos<br> dolores et quas molestias excepturi sint occaecati cupiditate.</p>
                                    <h5>James Reese</h5>
                                    Managing Director
                                </div>
                            </article>
                            <article class="grid_4">
                                    <h3 class="prev-indent-bot">What’s New?</h3>
                                <time class="tdate-1" datetime="2011-08-15"><a class="link" href="#">15.08.2011</a></time>
                                <p class="prev-indent-bot">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>
                                <time class="tdate-1" datetime="2011-08-11"><a class="link" href="#">11.08.2011</a></time>
                                Totam rem aperiam, eaque ipsa quae ab illo inven tore veritatis et quasi architecto.
                            </article>
                        </div>
                    </div>
                </div>
            </div>-->
        

            <!--==============================footer=================================-->
        <footer>
            <div id="footerTop" class="row">
                <div class="col-md-20 col-md-offset-2">
                    <div class="row">
                            <article class="col-md-8">
                                <h3 class="p2">Space Planning</h3>
                                <ul class="list-2">
                                    <li><a href="#">Totam rem aperiam eaque ipsa quae abillo</a></li>
                                    <li><a href="#">Inventore veritatis quasi architecto beatae vitae</a></li>
                                    <li><a href="#">Nemo enim ipsam voluptatem quia</a></li>
                                    <li><a href="#">Voluptas sit aspernatur aut odit aut fugit</a></li>
                                    <li><a href="#">Sed quia consequuntur magni dolores eos</a></li>
                                </ul>
                                
                            </article>
                            <article class="col-md-16">
                                <h3 class="p2">Selection &amp; Installation</h3>
                                <div class="row">
                                    <figure class="col-md-8 frame2">
                                        <?php echo Html::img('@css-img-web/page2-img2.jpg', ['class' => 'img-respons']); ?>
                                    </figure>
                                    <div class="col-md-16">
                                        <h6 class="p1">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias.</h6>
                                        <p class="textStyle2">Excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctioam libero tempore cum soluta.</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            
            
            
            <div id="footerBottom" class="row">
                <div class="col-md-20 col-md-offset-2">
                    <div class="row">
                        <div class="col-md-8 copy">
                            <div>Interior Design &copy; 2011 <a class="link color-3" href="#">Privacy Policy</a></div>
                            <div><a rel="nofollow" target="_blank" href="http://www.templatemonster.com/">Website Template</a> by TemplateMonster.com | <a rel="nofollow" target="_blank" href="http://www.html5xcss3.com/">html5xcss3.com</a></div>
                            <!-- {%FOOTER_LINK} -->
                        </div>
                        <div class="col-md-8">
                            <span class="phone-numb"><span>+1(800)</span> 123-1234</span>
                        </div>
                        <div class="col-md-8">
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
    </div><!--end container-fluid -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


