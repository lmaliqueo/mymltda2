<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name'=>'<b>MyM</b>Ltda',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    'components' => [
        'request' => [
            //'enableCookieValidation' => true,
            //'enableCsrfValidation' => true,
            'cookieValidationKey' => '1221',
            //'baseUrl' => '',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            /*'rules' => [
                '' => 'site/index',
                '<action>'=>'site/<action>',
            ],*/
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Usuario',
            //'client' => 'ActiveRecordClient',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        //'view' => [
        //     'theme' => [
        //         'pathMap' => [
        //            '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
        //         ],
        //     ],
        //],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'authManager' => [
            'class'=>'yii\rbac\DbManager',
        ],
    ],
    'params' => $params,
    'modules' => [
       'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
        'admin' => [
            'class' => 'mdm\admin\Module', 
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\models\Usuario',
                    'idField' => 'user_id'
                ],
                'other' => [
                    'class' => 'path\to\OtherController', // add another controller
                ],
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                'route' => null, // disable menu route 
            ]
        ],  
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/login', 
            'site/logout', 
            'site/error',
        ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
