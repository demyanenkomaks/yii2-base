<?php

use yii\helpers\Url;

?>
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?= Url::to(['/'])?>" class="logo logo-dark">
            <span class="logo-sm"><img src="/images/logo-sm.png" alt="" height="22"></span>
            <span class="logo-lg"><img src="/images/logo-dark.png" alt="" height="17"></span>
        </a>
        <!-- Light Logo-->
        <a href="<?= Url::to(['/'])?>" class="logo logo-light">
            <span class="logo-sm"><img src="/images/logo-sm.png" alt="" height="22"></span>
            <span class="logo-lg"><img src="/images/logo-light.png" alt="" height="17"></span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu"></div>

            <?php if (!Yii::$app->getUser()->isGuest) : ?>
                <?= backend\widgets\Menu::widget([
                    'items' => [
                        [
                            'label' => 'Menu',
                            'options' => ['class' => 'menu-title'],
                        ],
//                            [
//                                'label' => 'Пользователи',
//                                'url' => ['/user/'],
//                                'icon' => 'fa fa-users',
//                                'linkOptions' => ['class' => 'nav-link'],
//                            ],
                        [
                            'label' => 'Админ',
                            'icon' => 'fa fa-cog',
                            'url' => '#administration',
                            'id' => 'administration',
                            'items' => [
                                [
                                    'label' => 'Настройки',
                                    'url' => ['/config/'],
                                    'icon' => 'fa fa-cogs',
                                    'linkOptions' => ['class' => 'nav-link'],
                                ],
                                [
                                    'label' => 'Пользователи',
                                    'url' => ['/user-admin/user/'],
                                    'icon' => 'fa fa-users',
                                    'linkOptions' => ['class' => 'nav-link'],
                                ],
                            ],
                        ],
                    ],
                ]) ?>
            <?php else: ?>
                <?= backend\widgets\Menu::widget([
                    'items' => [
                        [
                            'label' => 'Menu',
                            'options' => ['class' => 'menu-title'],
                        ],
//                        ['label' => 'Gii', 'icon' => 'fa fa-file-code', 'url' => ['/gii/'], 'linkOptions' => ['class' => 'nav-link']],
//                        ['label' => 'Debug', 'icon' => 'ri-dashboard-line', 'url' => ['/debug/'], 'linkOptions' => ['class' => 'nav-link']],
                    ],
                ]) ?>
            <?php endif; ?>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
