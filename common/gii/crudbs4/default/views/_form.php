<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<?= "<?php " ?>$form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col-12">
                    <h4 class="page-title"><?= '<?= ' ?>Html::encode($this->title) ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= '<?= ' ?> Html::a(Html::tag('i', '', ['class' => 'fa fa-chevron-left']) . ' Назад', ['index'], ['class' => 'btn btn-warning mt-2']) ?>
                    <?= '<?= ' ?> Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-save']) . ($model->isNewRecord ? ' Добавить' :' Сохранить'), ['class' => 'btn btn-success ml-2 mt-2']) ?>
                    <?= '<?php ' ?> if (!$model->isNewRecord): ?>
                        <?= '<?= ' ?> Html::a(Html::tag('i', '', ['class' => 'fa fa-times']) . ' Удалить', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger ml-2 mt-2',
                            'data-confirm' => 'Удалить элемент?'
                        ]) ?>
                    <?= '<?php ' ?> endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <?php foreach ($generator->getColumnNames() as $attribute) {
                    if (in_array($attribute, $safeAttributes)) {
                        echo '<div class="col-12">' . PHP_EOL;
                        echo '                <?= ' . $generator->generateActiveField($attribute) . " ?>\n";
                        echo '</div>' . PHP_EOL;
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
<?= "<?php " ?>ActiveForm::end(); ?>

