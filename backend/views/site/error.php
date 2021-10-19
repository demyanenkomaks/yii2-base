<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$pattern = "/(\d)\d(\d)/i";
$replacement = "<span class=\"text-primary\">\$1</span><i class=\"ti-face-sad text-pink\"></i><span class=\"text-info\">\$2</span>";
$code = preg_replace($pattern,$replacement, $exception->statusCode);
?>

<div class="wrapper-page">
    <div class="ex-page-content text-center">
        <div class="text-error"><?= $code ?></div>
        <h2><?= $message ?></h2><br>
        <br>
        <?= Html::a(Yii::t('app', 'Вернуться на главную'), ['/'], ['class' => 'btn btn-default waves-effect waves-light']) ?>
    </div>
</div>