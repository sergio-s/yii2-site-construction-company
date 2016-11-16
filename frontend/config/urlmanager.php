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
                'gb/captcha' => 'guest-book/captcha',
                'gb/form' => 'guest-book/form',
                
                '/' => 'page/home',
                '<alias:[\w_-]+>' => 'page/normal',
                
                'signup' => 'auth/signup',
                'login' => 'auth/signup',
                'logout' => 'auth/logout',
                'auth/<action>' => 'auth/<action>',
                
                
                
                
            ],
        ];
?>
