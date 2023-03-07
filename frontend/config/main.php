<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$config = [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'files' => [
            'as access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => false,
                    ],
                ],
            ],
        ],
    ],
    'components' => [
        'request' => [
            'class' => 'common\components\Request',
            'csrfParam' => $_ENV['CSRF_PARAM_FRONTEND'],
            'cookieValidationKey' => $_ENV['COOKIE_VALIDATION_KEY_FRONTEND'],
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
            'class' => '\mix8872\yii\minify\View',
            'enableMinify' => filter_var($_ENV['ENABLE_MINIFY'], FILTER_VALIDATE_BOOLEAN),
            'concatCss' => true, // concatenate css
            'minifyCss' => true, // minificate css
            'concatJs' => true, // concatenate js
            'minifyJs' => true, // minificate js
            'minifyOutput' => true, // minificate result html page
            'webPath' => '@web', // path alias to web base
            'basePath' => '@webroot', // path alias to web base
            'minifyPath' => '@webroot/minify', // path alias to save minify result
            'jsPosition' => [ \yii\web\View::POS_END ], // positions of js files to be minified
            'forceCharset' => 'UTF-8', // charset forcibly assign, otherwise will use all of the files found charset
            'expandImports' => true, // whether to change @import on content
            'compressOptions' => ['extra' => true], // options for compress
            'excludeFiles' => [
                'jquery.js', // exclude this file from minification
                'app-[^.].js', // you may use regexp
            ],
            /*'excludeBundles' => [
                \app\helloworld\AssetBundle::class, // exclude this bundle from minification
            ],*/
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<action:[a-z\-_]+>' => 'site/<action>',
                '<controller:[a-z\-_]+>/<action:[a-z\-_]+>' => '<controller>/<action>',
                '<controller:[a-z\-_]+>/<action:[a-z\-_]+>/<page:[0-9a-z\-_]+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];


if (filter_var($_ENV['DEBUG_FRONTEND'], FILTER_VALIDATE_BOOLEAN)) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => explode(',', $_ENV['DEBUG_ALLOWED_IPS']),
    ];
}

if (filter_var($_ENV['GII_FRONTEND'], FILTER_VALIDATE_BOOLEAN)) {
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
