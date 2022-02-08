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
        'menu' => [
            'class' => \mix8872\menu\Module::class
        ],
    ],
    'components' => [
        'response' => [
            'class' => 'bicf\securityheaders\components\Response',
            'on afterPrepare' => ['bicf\securityheaders\components\Response', 'addSecurityHeaders'],
            'on beforeSend' => function($event) {
                $event->sender->headers->add('X-XSS-Protection', 1);
            },
            'modules' => [
                'XContentTypeOptions' => [
                    'class' => 'bicf\securityheaders\modules\HeaderXContentTypeOptions',
                    'value' => 'nosniff',
                ],
                'AccessControlAllowMethods' => [
                    'class' => 'bicf\securityheaders\modules\HeaderAccessControlAllowMethods',
                    'value' => 'GET, POST',
                ],
                'AccessControlAllowOrigin' => [
                    'class' => 'bicf\securityheaders\modules\HeaderAccessControlAllowOrigin',
                    'value' => "https://{$_SERVER['HTTP_HOST']}",
                ],
                'ContentSecurityPolicyAcl' => [
                    'class' => 'bicf\securityheaders\modules\HeaderContentSecurityPolicyAcl',
                    'enabled' => false,
                    'policies' => [
                        'default-src' => "'self' 'unsafe-inline' 'unsafe-eval'",
                        'frame-src' => "'self'",
                        'img-src' => "'self' data: www.google-analytics.com mc.yandex.ru www.google.com www.google.ru",
                        'font-src' => "'self' fonts.gstatic.com maxcdn.bootstrapcdn.com",
                        'media-src' => "'self' data:",
                        'script-src' => "'self' 'unsafe-inline' 'unsafe-eval' www.google-analytics.com mc.yandex.ru www.google.com www.google.ru",
                        'style-src' => "'self' 'unsafe-inline'",
                        'connect-src' => "'self'",
//                        'report-uri' => '/report-csp-acl',
                    ],
                ],
                'ContentSecurityPolicyMonitor' => [
                    'class' => 'bicf\securityheaders\modules\HeaderContentSecurityPolicyMonitor',
                    'policies' => [
                        'default-src' => "'self' 'unsafe-inline' 'unsafe-eval'",
                        'frame-src' => "'self'",
                        'img-src' => "'self' data: www.google-analytics.com mc.yandex.ru www.google.com www.google.ru",
                        'font-src' => "'self' 'unsafe-inline' 'unsafe-eval' data: fonts.gstatic.com maxcdn.bootstrapcdn.com",
                        'media-src' => "'self' data:",
                        'script-src' => "'self' 'unsafe-inline' 'unsafe-eval' www.google-analytics.com mc.yandex.ru www.google.com www.google.ru",
                        'style-src' => "'self' 'unsafe-inline'",
                        'connect-src' => "'self'",
//                        'report-uri' => "/report-csp-acl",
                    ],
                ],
            ],
        ],
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
            'crudbs4' => [
                'class' => 'common\gii\crudbs4\Generator', // generator class
                'templates' => [
                    'Template' => '@common/gii/crudbs4/bs4', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
