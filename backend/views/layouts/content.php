<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

?>
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="<?= Url::to(['/'])?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="/images/logo-sm.png" alt="" height="22">
                        </span>
                            <span class="logo-lg">
                            <img src="/images/logo-dark.png" alt="" height="17">
                        </span>
                        </a>

                        <a href="<?= Url::to(['/'])?>" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="/images/logo-sm.png" alt="" height="22">
                        </span>
                            <span class="logo-lg">
                            <img src="/images/logo-light.png" alt="" height="17">
                        </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    </button>
                </div>

                <div class="d-flex align-items-center">
                    <div class="ms-1 header-item d-none d-sm-flex">
                        <a href="/" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" target="_blank">
                            <i class='bx bx-sitemap fs-22'></i>
                        </a>
                    </div>

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                            <i class='bx bx-fullscreen fs-22'></i>
                        </button>
                    </div>

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                            <i class='bx bx-moon fs-22'></i>
                        </button>
                    </div>

                    <div class="ms-sm-3 header-item">
                        <?php
                        if (Yii::$app->user->isGuest) {
                            echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
                        } else {
                            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                                . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link logout text-decoration-none']
                                )
                                . Html::endForm();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
<!--        <div class="modal-dialog modal-dialog-centered">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header">-->
<!--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"-->
<!--                            id="NotificationModalbtn-close"></button>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <div class="mt-2 text-center">-->
<!--                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"-->
<!--                                   colors="primary:#f7b84b,secondary:#f06548"-->
<!--                                   style="width:100px;height:100px"></lord-icon>-->
<!--                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">-->
<!--                            <h4>Are you sure ?</h4>-->
<!--                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">-->
<!--                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>-->
<!--                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
    </div><!-- /.modal -->

    <?php include_once "topbar.php"; ?>

    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <?php if (isset($this->params['breadcrumbs'])): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <div class="page-title-right">
                                <?= Breadcrumbs::widget([
                                    'tag' => "ol",
                                    'options' => ['class' => 'breadcrumb m-0'],
                                    'itemTemplate' => "<li class=\"breadcrumb-item\">{link}</li>\n",
                                    'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                                    'links' => $this->params['breadcrumbs'],
                                ]) ?>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12">
                        <?= $content ?>
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <?= date('Y') ?> &copy; <a href="https://grechka.digital" target="_blank">grechka.digital</a>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
