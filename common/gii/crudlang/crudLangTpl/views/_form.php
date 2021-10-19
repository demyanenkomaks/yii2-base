<?php

use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$contentModel = new $generator->modelContentClass();
$modelClass = StringHelper::basename($generator->modelClass);
$modelContentClass = StringHelper::basename($generator->modelContentClass);
$safeAttributes = ArrayHelper::merge($model->safeAttributes(), $contentModel->safeAttributes());
if (empty($safeAttributes)) {
    $safeAttributes = ArrayHelper::merge($model->attributes(), $contentModel->attributes());
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<?= "<?php " ?>$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="panel-heading">
    <div class="form-group pull-left">
        <?= '<?=' ?> Html::tag('h3', $this->title) ?>
    </div>
    <div class="form-group pull-right">
        <?= '<?=' ?> Html::a(Html::tag('i', '', ['class' => 'fa fa-chevron-left']) . ' ' . Yii::t('app', 'Назад'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= '<?php' ?> if (!$model->isNewRecord): ?>
            <?= '<?=' ?> Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-floppy-o']) . ' ' . Yii::t('app', 'Обновить'), ['class' => 'btn btn-primary']) ?>
            <?= '<?=' ?> Html::a(Html::tag('i', '', ['class' => 'fa fa-remove']) . ' ' . 'Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => [
                            'confirm' => 'Вы действительно хотите удалить элемент?',
                            'method' => 'post'
                        ]]) ?>
        <?= '<?php' ?> else : ?>
            <?= '<?=' ?> Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-plus']) . ' ' . Yii::t('app', 'Добавить'), ['class' => 'btn btn-success']) ?>
        <?= '<?php' ?> endif; ?>
    </div>
</div>

<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($generator->getColumnNames() as $attribute) {
                if (in_array($attribute, $safeAttributes)) {
                    echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
                }
            } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs tabs tabs-top">
                <?= "<?php " ?>foreach ($langModels as $key => $lang): ?>
                <li class="active tab">
                    <a href="#<?= '<?=' ?> $key ?>" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs"><?= '<?=' ?> $key ?></span>
                    </a>
                </li>
                <?= "<?php " ?>endforeach; ?>
            </ul>
            <div class="tab-content">
                <?= "<?php " ?>foreach ($langModels as $key => $lang): ?>
                <div class="tab-pane active" id="<?= '<?=' ?> $key ?>">
                    <div class="row">
                        <?php foreach ($generator->getContentColumnNames() as $attribute) {
                            if (in_array($attribute, $safeAttributes)) {
                                echo "                            <div class=\"col-md-12\"><?= " . $generator->generateContentActiveField($attribute) . " ?></div>" . PHP_EOL;
                            }
                        } ?>
                        <div class="clear-both"></div>
                    </div>
                </div>
                <?= "<?php " ?>endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?= "<?php " ?>ActiveForm::end(); ?>