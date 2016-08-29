<?php
/*
 * Шаблон по умолчанию
 * В базовом контроллере подключаем шаблон - public $layout = '@app/views/layouts/tpl/page';
 * Выводим этот шаблон внутри базового шаблона layouts/main.php   
 * В layouts/main.php выводим через $content
 */
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="grid_12">
    <?= $content; ?>
</div>

<?php $this->endContent(); ?>