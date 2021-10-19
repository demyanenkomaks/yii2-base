<?php

return [
//    'name' => '',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'sourceLanguage' => 'ru',
    'language' => 'ru-RU',
    'modules' => [
        'files' => [
            'class' => 'mix8872\yiiFiles\Module',
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'controllers' => ['files/default'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ]
            ],
            'parameters' => [
                'sizesNameBy' => 'key',
                'filesNameBy' => 'translit',
                'savePath' => '/uploads/attachments/',
            ],
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'content' => [
            'class' => '\common\modules\content\Module'
        ],
    ],
    'components' => [
        'i18n' => [//multilang
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'forceTranslation' => true,
                    'basePath' => '@common/messages',
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'config' => [
            'class' => 'mix8872\config\components\Config'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-backend',
                'httpOnly' => true
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '/',
//            'enableStrictParsing' => false,
            'rules' => [
                '/' => 'site/index',
                // '<controller:[a-z\-]{1,50}>/<action:[a-z\-]{1,50}>' => '<controller>/<action>',
                // '<controller:[a-z\-]{1,50}>/<action:[a-z\-]{1,50}>/<param:[1-9][0-9]{0,10}>' => '<controller>/<action>'
            ],
        ],
    ],
];
