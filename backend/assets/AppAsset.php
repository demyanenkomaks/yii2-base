<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets';
    public $css = [
        'css/bootstrap.min.css',
        'libs/flatpickr/flatpickr.min.css',
        'libs/jquery-toast/jquery.toast.min.css',
        'css/icons.min.css',
        'css/app.css',
        'css/custom.css',
    ];
    public $js = [
//        'js/vendor.min.js',
        'libs/jquery-toast/jquery.toast.min.js',
        'js/jquery.slimscroll.js',
        'js/waves.js',
        'js/app.min.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        \yii\bootstrap4\BootstrapPluginAsset::class
    ];
}
