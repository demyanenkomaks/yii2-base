<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
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
            'csrfParam' => '_csrf-frontend',
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
            'enableMinify' => !YII_DEBUG,
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
