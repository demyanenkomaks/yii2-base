<?php

use yii\widgets\Breadcrumbs;

?>
<div class="wrapper">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-left mt-10">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <?= $content ?>
            </div>
        </div>
    </div> <!-- end container -->
</div>

<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <?= date('Y') ?> &copy; <a href="https://grechka.digital" target="_blank">grechka.digital</a>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->
