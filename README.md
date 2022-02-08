<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
web/                 contains frontend the entry script and Web resources
```

INSTALLATION
-------------------
### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

```
composer create-project demyanenkomaks/yii2-base or git clone ...
php init
php yii migrate-all
```

Update project
-------------------

```
git pull --ff-only origin dev
composer install
php yii migrate --interactive=0
```

Console Rbac
-------------------

```
php yii rbac/remove-all                             Удалить все данные: роли, разрешения, правила и назначения

php yii rbac/init-role-admin                        Добавленеи роли "admin" с доступом Управление пользователями
php yii rbac/init-role-admin-all                    Добавленеи роли "admin" с доступом ко всему

php yii rbac/add-admin {login} {password}           Добавленеи пользователя с ролью "admin"
php yii rbac/recovery-role-admin {login}            Востановление пользователю роли "admin"
php yii rbac/recovery-password {login} {password}   Востановление пароля пользователю
```


