<?php


namespace backend\widgets\popup;


use yii\base\Widget;

class Popup extends Widget
{
    public $model;

    public function run()
    {
        return $this->render('index', [
            'model' => $this->model
        ]);
    }
}