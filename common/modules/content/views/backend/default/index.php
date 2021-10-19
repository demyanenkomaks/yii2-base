<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\content\models\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Страницы');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel col-md-12">
    <div class="panel-heading">
        <h2 class="pull-left"><?= Html::encode($this->title) ?></h2>
        <div class="panel-heading__btn-block">
            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']) . ' Добавить страницу', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="panel-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                'code',
                [
                    'attribute' => 'status',
                    'filter' => [
                        1 => 'Да',
                        0 => 'Нет'
                    ],
                    'value' => function ($model) {
                        return $model->status ? 'Да' : 'Нет';
                    }
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                ],
            ],
        ]) ?>
    </div>
</div>
