<?php

return [
    'bundles' => [
        //регестрируем свой bootstrap за место встроенного
        'yii\bootstrap\BootstrapAsset' => [
            'sourcePath' => null, // не опубликовывать комплект
//            'basePath' => '@webroot',
//            'baseUrl' => '@web',
//            'css' => ['css/bootstrap/bootstrap.min.css','css/bootstrap/bootstrap-theme.min.css'],
//            'js' => ['js/bootstrap.min.js']
            
        ],
        //регестрируем свой jquery за место встроенного
        'yii\web\JqueryAsset' => [
            'sourcePath' => null, // не опубликовывать комплект
            'basePath' => '@webroot',
            'baseUrl' => '@web',
            'js' => [
                        'js/jquery-1.11.3.min.js',
//                              YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js',
            ]
        ],
    ],
];