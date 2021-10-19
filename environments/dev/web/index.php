<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

define('YII_APP', 'frontend');

require(__DIR__ . '/../protected/vendor/autoload.php');
require(__DIR__ . '/../protected/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../protected/common/config/bootstrap.php');
require(__DIR__ . '/../protected/' . YII_APP . '/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../protected/common/config/main.php'),
    require(__DIR__ . '/../protected/common/config/main-local.php'),
    require(__DIR__ . '/../protected/' . YII_APP . '/config/main.php'),
    require(__DIR__ . '/../protected/' . YII_APP . '/config/main-local.php')
);

$application = new yii\web\Application($config);
$application->run();
