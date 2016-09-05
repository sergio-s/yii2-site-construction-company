<?php
return [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                'galery/photo/<alias:[\w_-]+>' => 'photo/pic',
                'galery/category/<alias:[\w_-]+>' => 'photo/category',
                'galery/<pageNum:\d+>' => 'photo/index',
                'galery' => 'photo/index',
                
                'gb/<pageNum:\d+>' => 'guest-book/index',
                'gb' => 'guest-book/index',
                
                '/' => 'page/home',
                '<alias:[\w_-]+>' => 'page/normal',
                
                
                
                
            ],
        ];
?>
