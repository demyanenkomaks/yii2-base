<?php

namespace backend\widgets\popup\assets;

use backend\assets\AppAsset;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class PopupAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets';
    public $css =[
        'css/carousel.css',
        'libs/slick-1.8.1/slick/slick.css',
        'libs/slick-1.8.1/slick/slick-theme.css',
        'libs/magnific-popup/magnific-popup.css'
    ];
    public $js = [
        'libs/slick-1.8.1/slick/slick.min.js',
        'libs/magnific-popup/jquery.magnific-popup.min.js',
        'js/popup.js',
    ];
    public $depends = [
        AppAsset::class
    ];
}
