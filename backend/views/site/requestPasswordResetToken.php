<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Сброс пароля');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <a href="/">
                                <span><img src="/img/logo/logo.png" alt="" height="70"></span>
                            </a>
                            <p class="text-muted mb-4 mt-3">Введите ваш email адрес и мы вышлем на него дальнейшие инструкции</p>
                        </div>

                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form-horizontal m-t-20']); ?>

                            <?= $form->field($model, 'email') ?>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit">Сбросить пароль</button>
                            </div>

                        <?php ActiveForm::end(); ?>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p>Вернуться на <a href="/" class="ml-1"><b>страницу входа</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
