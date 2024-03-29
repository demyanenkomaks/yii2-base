<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Вход');
?>
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <span><img src="/images/logo-dark.png" alt="" height="30"></span>
                            <p class="text-muted mb-4 mt-3">Введите ваш логин и пароль для доступа</p>
                        </div>

                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form-horizontal m-t-20']); ?>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>



                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <?= Html::activeCheckbox($model, 'rememberMe', ['id' => 'checkbox-signin', 'class' => 'custom-control-input', 'label' => null]) ?>
                                <label class="custom-control-label" for="checkbox-signin">Запомнить меня</label>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit">Войти</button>
                        </div>
                        <?php ActiveForm::end(); ?>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

<footer class="footer footer-alt">
    <?= date('Y') ?> © <a href="https://grechka.digital" target="_blank">grechka.digital</a>
</footer>
