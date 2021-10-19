<?php
/**
 * Created by PhpStorm.
 * User: Mix
 * Date: 01.11.2018
 * Time: 19:52
 */

namespace common\modules\content\controllers\frontend;

use Yii;
use common\modules\content\models\Content;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex($id)
    {
        $model = $this->_findModel($id);
        $this->view->title = $model->title;
        if ($model->template) {
            return $this->render($model->template, compact('model'));
        } else {
            return $this->render('index', compact('model'));
        }
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return array|Content|ActiveRecord|null the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function _findModel($id)
    {
        if (($model = Content::find()->where('code=:id', [':id' => $id])->andWhere(['status' => Content::STATUS_ACTIVE])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'Страница не существует'));
    }
}