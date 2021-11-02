<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;


class MigrateAllController extends Controller
{
    public function actionIndex() {

        $migration = new \yii\console\controllers\MigrateController('migrate', Yii::$app);
        $migration->runAction('up', ['migrationPath' => '@yii/rbac/migrations', 'interactive' => false]);

        $migration = new \yii\console\controllers\MigrateController('migrate', Yii::$app);
        $migration->runAction('up', ['migrationPath' => null, 'migrationNamespaces' => 'mix8872\config\migrations', 'interactive' => false]);

        $migration = new \yii\console\controllers\MigrateController('migrate', Yii::$app);
        $migration->runAction('up', ['migrationPath' => null, 'migrationNamespaces' => 'mix8872\menu\migrations', 'interactive' => false]);

        $migration = new \yii\console\controllers\MigrateController('migrate', Yii::$app);
        $migration->runAction('up', ['migrationPath' => null, 'migrationNamespaces' => 'mix8872\useradmin\migrations', 'interactive' => false]);

        $migration = new \yii\console\controllers\MigrateController('migrate', Yii::$app);
        $migration->runAction('up', ['migrationPath' => '@vendor/mix8872/yii2-files/src/migrations', 'interactive' => false]);

        $migration = new \yii\console\controllers\MigrateController('migrate', Yii::$app);
        $migration->runAction('up', ['migrationPath' => '@console/migrations/', 'interactive' => false]);

        exit(0);
    }
}
