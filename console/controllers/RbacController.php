<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller
{

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');

        // запишем их в БД
        $auth->add($admin);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);

        // Теперь добавим наследования. Для роли editor мы добавим разрешение updateNews,
        // а для админа добавим наследование от роли editor и еще добавим собственное разрешение viewAdminPage

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);
    }

    /**
     * Удалить все данные: роли, разрешения, правила и назначения
     */
    public function actionRemoveAll()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        echo 'Удалено';
    }

    /**
     * Добавленеи роли "admin" с доступом Управление пользователями
     */
    public function actionInitRoleAdmin()
    {
        $auth = Yii::$app->authManager;

        // Создаем роли Админ
        $admin = $auth->createRole('admin');

        // Путь модуля Управление пользователями
        $routeUserAdmin = $auth->createPermission('/user-admin/*');

        // Создаем разрешения Управление пользователями
        $userAdmin = $auth->createPermission('userAdmin');
        $userAdmin->description = 'Управление пользователями';

        // Запишем в БД
        $auth->add($admin);
        $auth->add($routeUserAdmin);
        $auth->add($userAdmin);

        // Добавление пути Управление пользователями -> разрешению Управление пользователями -> роли Админ
        $auth->addChild($userAdmin, $routeUserAdmin);
        $auth->addChild($admin, $userAdmin);

        echo 'Добавлена роль "admin"';
    }

    /**
     * Добавленеи роли "admin" с доступом ко всему
     */
    public function actionInitRoleAdminAll()
    {
        $auth = Yii::$app->authManager;

        // Создаем роли Админ
        $admin = $auth->createRole('admin');

        // Путь ко всему сайту
        $routeUserAdmin = $auth->createPermission('/*');

        // Запишем в БД
        $auth->add($admin);
        $auth->add($routeUserAdmin);

        // Добавление пути -> роли Админ
        $auth->addChild($admin, $routeUserAdmin);

        echo 'Добавлена роль "admin"';
    }

    /**
     * Добавленеи пользователя с ролью "admin"
     * @param string $login
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function actionAddAdmin($login = '', $password = '') {

        if ($login !== '' && $password !== '') {
            $user = new User();
            $user->username = $login;
            $user->email = Yii::$app->security->generateRandomString(15) . '@root.ru';
            $user->setPassword($password);
            $user->generateAuthKey();
            $user->save();
            echo 'Добавлен пользователь "' . $login . '"';

            $auth = Yii::$app->authManager;
            $admin = $auth->createRole('admin');
            $auth->assign($admin, $user->id);

            echo 'Назначена ему роль "admin"';
        } else {
            echo 'Укажите логин и пароль';
        }
    }

    /**
     * Востановление пользователю роли "admin"
     * @param string $login
     * @throws \Exception
     */
    public function actionRecoveryRoleAdmin($login = '') {

        if ($login !== '') {
            $user = User::find()->where(['username' => $login])->one();
            if ($user) {
                $auth = Yii::$app->authManager;
                $admin = $auth->createRole('admin');
                $auth->assign($admin, $user->id);

                echo 'Востановлена роль "admin" пользователю "' . $login . '"';
            } else {

                echo 'Пользователь с логином "' . $login . '" не найден';
                exit();
            }
        } else {
            echo 'Укажите логин';
        }
    }

    /**
     * Востановление пароля пользователю
     * @param string $login
     * @param string $password
     * @throws \Exception
     */
    public function actionRecoveryPassword($login = '', $password = '') {

        if ($login !== '' && $password !== '') {
            $user = User::find()->where(['username' => $login])->one();
            if ($user) {
                $user->setPassword($password);
                $user->save();

                echo 'Пароль пользователю "' . $login . '" востановлен';
            } else {

                echo 'Пользователь с логином "' . $login . '" не найден';
                exit();
            }
        } else {
            echo 'Укажите логин и пароль';
        }
    }
}
