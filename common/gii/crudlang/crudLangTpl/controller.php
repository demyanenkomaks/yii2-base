<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
use <?= ltrim($generator->modelClass, '\\') ?>Content;
<?php if (!empty($generator->searchModelClass)): ?>
    use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
    use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all <?= $modelClass ?> models.
     * @return mixed
     */
    public function actionIndex()
    {
    <?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    <?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    <?php endif; ?>
    }

    /**
     * Creates a new <?= $modelClass ?> model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new <?= $modelClass ?>();
        $langs = Yii::$app->getModule('languages')->languages;
        $saved = true;

        $langModels = array();
        foreach ($langs as $lang) {
            $langModels[$lang] = new <?= $modelClass ?>Content();
        }

        if($model->load(Yii::$app->request->post()) && Model::loadMultiple($langModels, Yii::$app->request->post())){
            if ($model->save()) {
                foreach ($langModels as $item){
                    $item-><?= strtolower($modelClass) ?>_id = $model->id;
                    if(!$item->save()) {
                        error_log(print_r($item->getErrorSummary(1),1));
                        $saved = false;
                    }
                }
                if($saved) {
                    Yii::$app->getSession()->setFlash('success', Yii::t('app', '<?= $modelClass ?> was added'));
                    return $this->redirect(['index']);
                } else {
                    $model->delete();
                    Yii::$app->getSession()->setFlash('error', Yii::t('app', '<?= $modelClass ?> adding error'));
                }
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', '<?= $modelClass ?> adding error'));
                error_log(print_r($model->getErrorSummary(1),1));
            }
        }

        return $this->render('create', [
            'model' => $model,
            'langModels' => $langModels,
        ]);
    }

    /**
     * Updates an existing <?= $modelClass ?> model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(<?= $actionParams ?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);
        $saved = true;
        $langModels = <?= $modelClass ?>Content::find()->where(['<?= strtolower($modelClass) ?>_id' => $model->id])->indexBy('lang')->all();

        if($model->load(Yii::$app->request->post()) && Model::loadMultiple($langModels, Yii::$app->request->post())){
            if ($model->save()) {
                foreach ($langModels as $item) {
                    if (!$item->save()) {
                        error_log(print_r($item->getErrorSummary(1),1));
                        $saved = false;
                    }
                }
                if($saved) {
                    Yii::$app->getSession()->setFlash('success', Yii::t('app', '<?= $modelClass ?> was saved'));
                    return $this->redirect(['index',]);
                } else {
                    Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Error when update <?= $modelClass ?>'));
                }
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Error when update <?= $modelClass ?>'));
                error_log(print_r($model->getErrorSummary(1),1));
            }
        }

        return $this->render('update', [
            'model' => $model,
            'langModels' => $langModels
        ]);
    }

    /**
     * Deletes an existing <?= $modelClass ?> model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(<?= $actionParams ?>)
    {
        if ($this->findModel(<?= $actionParams ?>)->delete()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', '<?= $modelClass ?> was deleted'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the <?= $modelClass ?> model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return <?=                   $modelClass ?> the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(<?= $actionParams ?>)
    {
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(<?= $generator->generateString('The requested page does not exist.') ?>);
    }
}
