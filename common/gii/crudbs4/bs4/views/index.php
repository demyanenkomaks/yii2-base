<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use kartik\export\ExportMenu;
use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "kartik\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'class' => '\kartik\grid\CheckboxColumn',
        'checkboxOptions' => function ($model) {
            return [
                'value' => $model->id,
                'class' => 'js-batch-checkbox'
            ];
        },
        'rowSelectedClass' => 'info',
    ];
<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
	foreach ($generator->getColumnNames() as $name) {
		if (++$count < 6) {
			echo "      '" . $name . "',\n";
		} else {
			echo "      //'" . $name . "',\n";
		}
	}
} else {
	foreach ($tableSchema->columns as $column) {
		$format = $generator->generateColumnFormat($column);
		if (++$count < 6) {
			echo "      '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
		} else {
			echo "      //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
		}
	}
}
?>
    ['class' => 'kartik\grid\ActionColumn'],
];
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col-12">
                    <h4 class="page-title"><?= '<?= ' ?> Html::encode($this->title) ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= '<?= ' ?> Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']) . ' Добавить', ['create'], [
                        'class' => 'btn btn-info',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : '' ?>
<?php if(!empty($generator->searchModelClass)): ?>
<?= '    <?php ' . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <div class="card-box">
<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= '        <?= ' ?>GridView::widget([
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "        'filterModel' => \$searchModel,\n" : '' ?>
                'panel' => ['heading' => '<h3></h3>'],
                'toolbar' => [
                    [
                        'content' =>
                        Html::a('<i class="fas fa-trash-alt"></i>', ['delete'], [
                            'class' => 'btn btn-danger js-batch-action hidden',
                            'title' => 'Удалить выбранные элементы',
                            'data' => [
                                'message' => 'Удалить выбранные элементы?'
                            ]
                        ]),
                    ],
                    'export' => [
                        'content' => ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $columns,
                            'showColumnSelector' => false
                        ])
                    ],
                    '{toggleData}'
                ],
                'columns' => $columns
            ]) ?>
<?php else: ?>
    <?= '            <?= ' ?>ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                },
            ]) ?>
<?php endif; ?>
        </div>
    </div>
</div>
<?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>
