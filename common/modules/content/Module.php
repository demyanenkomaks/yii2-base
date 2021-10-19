<?php
/**
 * Created by PhpStorm.
 * User: Mix
 * Date: 30.10.2018
 * Time: 18:15
 */

namespace common\modules\content;

use Yii;

class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if (preg_match('/backend/ui', Yii::$app->id)) {
            $this->controllerNamespace = "common\\modules\\{$this->id}\\controllers\\backend";
            $this->setViewPath("@common/modules/{$this->id}/views/backend");
        } else {
            $this->controllerNamespace = "common\\modules\\{$this->id}\\controllers\\frontend";
            $this->setViewPath("@common/modules/{$this->id}/views/frontend");
        }
    }
}