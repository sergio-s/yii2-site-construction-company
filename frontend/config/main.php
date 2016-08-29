<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Сайт частных мастеров',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    //для того, чтобы роутер находил контроллеры в подпапках
    'controllerMap' => [
        'page' =>[
                'class' =>'frontend\controllers\page\PageController'
        ],
        'photo' =>[
                'class' =>'frontend\controllers\photo\PhotoController'
        ],
        
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => $baseUrl,
            'cookieValidationKey' => 'shtrp[;p;,bnmqdbhmbnoytj,m485jhio-2',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        
        'urlManager' => require(__DIR__ . '/urlmanager.php'),
        
        'errorHandler' => [
            'errorAction' => 'error/error',//контроллер и экшэн обработки ошибок
        ],
       
    ],
    'params' => $params,
];
