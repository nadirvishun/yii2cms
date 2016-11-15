<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    //修改migration模板
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'templateFile'=>'@yii/views/migration.php',
            'generatorTemplateFiles' => [
                'create_table' => '@console/views/createTableMigration.php',
                'drop_table' => '@yii/views/dropTableMigration.php',
                'add_column' => '@console/views/addColumnMigration.php',
                'drop_column' => '@console/views/dropColumnMigration.php',
                'create_junction' => '@yii/views/createJunctionMigration.php'
            ],
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
