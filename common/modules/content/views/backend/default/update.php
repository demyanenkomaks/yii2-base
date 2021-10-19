<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\content\models\Content */

$this->title = Yii::t('app', 'Редактирование страницы: ' . $model->title, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="panel panel-default col-md-12">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
