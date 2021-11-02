<?php
defined('YII_ENV') or define('YII_ENV', 'dev');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../common/config/env.php');

define('YII_APP', 'frontend');
defined('YII_DEBUG') or define('YII_DEBUG', filter_var($_ENV['DEBUG_FRONTEND'], FILTER_VALIDATE_BOOLEAN));

require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../common/config/bootstrap.php');
require(__DIR__ . '/../' . YII_APP . '/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../common/config/main.php'),
    require(__DIR__ . '/../common/config/main-local.php'),
    require(__DIR__ . '/../' . YII_APP . '/config/main.php'),
    require(__DIR__ . '/../' . YII_APP . '/config/main-local.php')
);

$application = new yii\web\Application($config);
$application->run();
