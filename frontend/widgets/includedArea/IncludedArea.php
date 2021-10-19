<?php

namespace frontend\widgets\includedArea;

use Yii;
use yii\base\Widget;

class IncludedArea extends Widget
{
    public $directory = 'includes';
    public $name;

    public function run()
    {
        $directoryPath = Yii::getAlias("@webroot/{$this->directory}");
        if (!is_dir($directoryPath) && !mkdir($directoryPath, 0755, true) && !is_dir($directoryPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directoryPath));
        }

        $filePath = "$directoryPath/{$this->name}_inc.php";

        if (!file_exists($filePath)) {
            touch($filePath);
        }

        return $this->renderFile($filePath);
    }
}