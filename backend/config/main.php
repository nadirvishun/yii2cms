<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
            ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'backend\models\Admin',
            'enableAutoLogin' => true,
             'identityCookie' => [
                'name' => '_backendUser', // unique for backend
            ],
        ],
        'session' => [
                'name' => 'PHPBACKSESSID',
                'savePath' => sys_get_temp_dir(),
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
        'i18n' => [
            'translations' => [
                'kvdialog' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                    'forceTranslation' => true
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        // 后台改用adminlte模板
       // 'view' => [
       //      'theme' => [
       //          'pathMap' => [
       //              '@app/views' => '@backend/themes/default'
       //          ],
       //          'baseUrl' => '@web/themes/default',
       //      ],
       //  ],
        //后台模板颜色
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-purple',
                ],
            ],
        ],
           /*"skin-blue",
                    "skin-black",
                    "skin-red",
                    "skin-yellow",
                    "skin-purple",
                    "skin-green",
                    "skin-blue-light",
                    "skin-black-light",
                    "skin-red-light",
                    "skin-yellow-light",
                    "skin-purple-light",
                    "skin-green-light"
                    */
    ],
    'params' => $params,
];
