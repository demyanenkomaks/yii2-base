<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];

if (filter_var($_ENV['DEBUG_BACKEND'], FILTER_VALIDATE_BOOLEAN)) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
}

if (filter_var($_ENV['GII_BACKEND'], FILTER_VALIDATE_BOOLEAN)) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '10.10.5.*'],
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
