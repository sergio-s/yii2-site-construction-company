<?php
/*
 * Шаблон по умолчанию
 * В базовом контроллере подключаем шаблон - public $layout = '@app/views/layouts/tpl/page';
 * Выводим этот шаблон внутри базового шаблона layouts/main.php   
 * В layouts/main.php выводим через $content
 */
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<article class="col-md-16">
    <?= $content; ?>
</article>

<div class="bg-sidebar"></div>
<div id="sidebar" class="col-md-8">
    <div class="row">
        <div class="menu_vert col-md-24">
            <h3>Наши услуги</h3>
            <ul class="list-2">
                <li><a href="#">Шпаклевка </a></li>
                <li><a href="#">Укладка плитки</a></li>
                <li><a href="#">Сантехника</a></li>
                <li><a href="#">Электрика</a></li>
                <li class="last-item"><a href="#">Поклейка обоев</a></li>
            </ul>
        </div>

        <p class="sep"></p>

        <div class="lastPhoto col-md-24">
            <h3>Новые фото</h3>
            <ul class="textStyle2">
                <li>
                    <p class="lastPhoto-title"><a href="" title="">Установили смеситель в ванной с боку</a></p>
                    <a href="" class="lastPhoto-img"><img title="" alt="" src=""></a>
                    <p class="lastPhoto-post">Когда мы делали ремонт ванной, то учли все потребности заказчика. Вообще в...</p>
                    <div class="lastPhoto-cnt">
                        <i class="fa fa-clock-o"></i><strong title="Дата добавления на сайт"> 15.11.2015</strong>
                        <i class="fa fa-comments-o"></i><strong title="Комментарии"> 0</strong>
                    </div>
                </li>

                <li>
                    <p class="lastPhoto-title"><a href="" title="">Установили смеситель в ванной с боку</a></p>
                    <a href="" class="lastPhoto-img"><img title="" alt="" src=""></a>
                    <p class="lastPhoto-post">Когда мы делали ремонт ванной, то учли все потребности заказчика. Вообще в...</p>
                    <div class="lastPhoto-cnt">
                        <i class="fa fa-clock-o"></i><strong title="Дата добавления на сайт"> 15.11.2015</strong>
                        <i class="fa fa-comments-o"></i><strong title="Комментарии"> 0</strong>
                    </div>
                </li>
            </ul>
        </div>

        <p class="sep"></p>

        <div class="lastArticle col-md-24">
            <h3>Новые записи</h3>
            <ul class="textStyle2">
                <li>
                    <div class="lastArticle-cnt"><i class="fa fa-calendar"></i><span>16 апреля 2012 г.</span></div>
                    <div>
                        <a class="lastArticle-title" href="blog.html">The Newest Innovation On Wooden Innovation On Wooden</a>
                        <a href="" class="lastArticle-img"><img title="" alt="" src=""></a>
                        <p class="lastArticle-post">You can replace all this text with your own text. What’s more, they’re absolutely free!</p>
                    </div>
                </li>
                <li>
                    <div class="lastArticle-cnt"><i class="fa fa-calendar"></i><span>16 апреля 2012 г.</span></div>
                    <div>
                        <a class="lastArticle-title" href="blog.html">The Newest Innovation On Wooden Innovation On Wooden</a>
                        <a href="" class="lastArticle-img"><img title="" alt="" src=""></a>
                        <p class="lastArticle-post">You can replace all this text with your own text. What’s more, they’re absolutely free!</p>
                    </div>
                </li>
                <li>
                    <div class="lastArticle-cnt"><i class="fa fa-calendar"></i><span>16 апреля 2012 г.</span></div>
                    <div>
                        <a class="lastArticle-title" href="blog.html">The Newest Innovation On Wooden Innovation On Wooden</a>
                        <a href="" class="lastArticle-img"><img title="" alt="" src=""></a>
                        <p class="lastArticle-post">You can replace all this text with your own text. What’s more, they’re absolutely free!</p>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</div>

<?php $this->endContent(); ?>