<?php

namespace common\modules\languages\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;


class ListWidget extends Widget
{

    public $array_languages;

    public function init()
    {
        $language = Yii::$app->language; //текущий язык

        //Создаем массив ссылок всех языков с соответствующими GET параметрами
        $array_lang = [];
        foreach (Yii::$app->getModule('languages')->languages as $value) {
            if ($value == $language) {
                $array_lang += [$value => Html::tag('span', $value, ['class' => 'header-lang__' . $value . ' active'])];
            } else {
                $array_lang += [$value => Html::a($value, ['/languages/default/index', 'lang' => $value], ['class' => 'header-lang__' . $value])];
            }
        }

        //ссылку на текущий язык не выводим
//        if (isset($array_lang[$language])) unset($array_lang[$language]);
        $this->array_languages = $array_lang;
    }

    public function run()
    {
        return $this->render('list', [
            'array_lang' => $this->array_languages
        ]);
    }

}
