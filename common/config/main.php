<?php

use \yii\web\Request;
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
$baseUrl = str_replace('/backend/web', '', $baseUrl);

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => require(__DIR__ . '/aliases.php'),
    'language' => 'ru-RU',//язык нашего сайта по умолчанию
    'sourceLanguage' => 'ru-RU',
    
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        //для ссылок в админки во фронт и на оборот
        'urlManagerFrontend' => require(dirname(dirname (__DIR__ )).'/frontend/config/urlmanager.php'),
        'urlManagerBackend' =>  require(dirname(dirname (__DIR__ )).'/backend/config/urlmanager.php'),
        
        'assetManager' => require(__DIR__ . '/assetManager.php'),
        
    ],
];
