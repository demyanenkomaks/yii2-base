<?php

use mix8872\filesAttacher\widgets\FilesWidget;
use sadovojav\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\content\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="panel-heading">
    <div class="form-group pull-left">
        <?= Html::tag('h3', $this->title) ?>
    </div>
    <div class="form-group pull-right">
        <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-chevron-left']) . ' ' . Yii::t('app', 'Назад'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?php if (!$model->isNewRecord): ?>
            <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-floppy-o']) . ' ' . Yii::t('app', 'Обновить'), ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-remove']) . ' ' . 'Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => [
                'confirm' => 'Вы действительно хотите удалить элемент?',
                'method' => 'post'
            ]]) ?>
        <?php else : ?>
            <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-plus']) . ' ' . Yii::t('app', 'Добавить'), ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </div>
</div>

<div class="panel-body">
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'status')->checkbox(['checked' => $model->isNewRecord ? true : null]) ?>
        </div>
        <div class="col-md-6 js-full">
            <?= $form->field($model, 'full')->checkbox(['class' => 'js-fullWidth']) ?>
            <?php if (!$model->full) : ?>
                <div class="row">
                    <div class="col-md-6"><?= $form->field($model, 'sideTitle')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-md-6"><?= $form->field($model, 'sideText')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-md-6"><?= $form->field($model, 'sideUrl')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-md-6"><?= $form->field($model, 'sideBtn')->textInput(['maxlength' => true]) ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'template')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'description')->widget(CKEditor::class, [
                        'editorOptions' => [
                            'allowedContent' => true,
                            'forcePasteAsPlainText' => true,
                            'toolbar' => [
                                ['Source'],
                                ['PasteText', '-', 'Undo', 'Redo'],
                                ['Replace', 'SelectAll'],
                                ['Format', 'FontSize'],
                                ['Bold', 'Italic', 'Underline', 'TextColor'],
                                ['RemoveFormat', 'Blockquote', 'HorizontalRule'],
                                ['NumberedList', 'BulletedList'],
                                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                                ['Link', 'Unlink'],
                                ['Maximize', 'ShowBlocks'],
                                ['test']
                            ],
                            'inline' => false,
                        ],
                    ]) ?>
                </div>
                <div class="clear-both"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= FilesWidget::widget([
                'model' => $model,
                'tag' => 'images',
                'multiple' => true,
                'filetypes' => ['image/*'],
            ]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
