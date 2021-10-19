<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => '%DB_CONNECTION%:host=%DB_HOST%;dbname=%DB_DATABASE%',
            'username' => '%DB_USERNAME%',
            'password' => '%DB_PASSWORD%',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
