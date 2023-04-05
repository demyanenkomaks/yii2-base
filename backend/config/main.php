<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['admin'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
            'roots' => [
                [
                    'baseUrl' => '@web',
                    'basePath' => '@webroot',
                    'path' => 'uploads',
                    'name' => 'Uploads',
                    'options' => [
                        'uploadOverwrite' => false,
                        'uploadAllow' => ['image', 'video', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/rtf', 'text/plain',
                            'image/vnd.djvu', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
                        'uploadDeny' => [],
                        'uploadOrder' => ['allow', 'deny'],
                        'uploadMaxSize' => '500M',
                        'disabled' => ['mkfile'],
                    ],
                ]
            ]
        ],
    ],
    'as access' => [
        'class' => 'mix8872\useradmin\components\AccessControl',
        'allowActions' => [
//            '*',
            'site/logout',
        ]
    ],
    'modules' => [
        'user-admin' => [
            'class' => 'mix8872\useradmin\Module',
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ]
            ]
        ],
        'config' => [
            'class' => \mix8872\config\Module::class
        ],
    ],
    'components' => [
        'request' => [
            'class' => 'common\components\Request',
            'csrfParam' => $_ENV['CSRF_PARAM_BACKEND'],
            'cookieValidationKey' => $_ENV['COOKIE_VALIDATION_KEY_BACKEND'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:[a-z\-]{1,50}>/<action:[a-z\-]{1,50}>' => '<controller>/<action>',
                '<controller:[a-z\-]{1,50}>/<action:[a-z\-]{1,50}>/<param:[1-9][0-9]{0,10}>' => '<controller>/<action>'
            ],
        ],
    ],
    'params' => $params,
];

if (filter_var($_ENV['DEBUG_BACKEND'], FILTER_VALIDATE_BOOLEAN)) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => explode(',', $_ENV['DEBUG_ALLOWED_IPS']),
    ];
}

if (filter_var($_ENV['GII_BACKEND'], FILTER_VALIDATE_BOOLEAN)) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => explode(',', $_ENV['GII_ALLOWED_IPS']),
        'generators' => [
            'crudlang' => [
                'class' => 'common\gii\crudlang\Generator', // generator class
                'templates' => [
                    'Template_lng' => '@common/gii/crudlang/crudLangTpl', // template name => path to template
                ]
            ],
            'crudbs5' => [
                'class' => 'common\gii\crudbs5\Generator', // generator class
                'templates' => [
                    'Template' => '@common/gii/crudbs5/bs5', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
