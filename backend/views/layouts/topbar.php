<?php

use yii\helpers\Html;

?>
<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-menu">
        <div class="container-fluid">
            <div class="logo-box">
                <a href="/" class="logo text-center">
                    <span class="logo-lg">
                        <img src="/img/logo/logo.png" alt="" height="20">
                    </span>
                    <span class="logo-sm">
                        <img src="/img/logo/logo.png" alt="" height="20">
                    </span>
                </a>
            </div>
            <a class="navbar-toggle nav-link float-right">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <div id="navigation">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <!-- Navigation Menu-->
                    <?= \mix8872\menu\widgets\MenuWidget::widget([
                        'code' => 'main-menu',
                        'isParentActive' => true,
                        'menuClassName' => 'navigation-menu in',
                        'parentClassName' => 'has-submenu',
                        'submenuClassName' => 'submenu'
                    ]) ?>
                <?php endif; ?>
                <?php if (Yii::$app->user->can('admin')) : ?>
                    <?= backend\widgets\Menu::widget([
                            'options' => [
                                'class' => 'navigation-menu',
                                'tag' => false,
                            ],
                            'labelTemplate' => '{label}',
                            'isParentCssClass' => 'has-submenu',
                            'items' => [
                                [
                                    'label' => 'Администрирование',
                                    'icon' => 'fa fa-cog',
                                    'visible' => Yii::$app->user->can('admin'),
                                    'linkOptions' => ['class' => 'has-submenu'],
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => Yii::t('app', 'Меню'),
                                            'url' => ['/menu/'],
                                            'icon' => 'fa fa-bars'
                                        ],
                                        [
                                            'label' => Yii::t('app', 'Настройки'),
                                            'url' => ['/config/'],
                                            'icon' => 'fa fa-cogs'
                                        ],
                                        [
                                            'label' => Yii::t('app', 'Пользователи'),
                                            'url' => ['/user-admin/user/'],
                                            'icon' => 'fa fa-users'
                                        ],
                                    ]
                                ],
//                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                            ],
                        ]) ?>
                <?php endif; ?>
                <?= backend\widgets\Menu::widget([
                    'options' => [
                        'class' => 'navigation-menu float-right',
                        'tag' => false,
                    ],
                    'labelTemplate' => '{label}',
                    'isParentCssClass' => 'has-submenu',
                    'items' => [
                        [
                            'label' => Yii::t('app', 'Выход'),
                            'visible' => !Yii::$app->user->isGuest,
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post'],
                            'icon' => 'ti-power-off'
                        ],
                        [
                            'label' => Yii::t('app', 'Вход'),
                            'visible' => Yii::$app->user->isGuest,
                            'url' => ['/site/login'],
                            'linkOptions' => ['data-method' => 'post'],
                            'icon' => 'ti-arrow-right'
                        ],
                    ]
                ]) ?>
                <!-- End navigation menu -->

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end navbar-custom -->

</header>
<!-- End Navigation Bar-->
