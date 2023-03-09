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
        [
            'href' => '/img/favicon/favicon.ico',
            'rel' => 'icon',
            'sizes' => '32x32',
        ],
//        'css/bootstrap.min.css',
        'libs/flatpickr/flatpickr.min.css',
        'libs/jquery-toast/jquery.toast.min.css',
        'css/icons.min.css',
        'css/app.css',
        'css/custom.css',
    ];
    public $js = [
        'libs/jquery-toast/jquery.toast.min.js',
        'js/jquery.slimscroll.js',
        'js/waves.js',
        'js/app.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap4\BootstrapPluginAsset'
    ];
}
