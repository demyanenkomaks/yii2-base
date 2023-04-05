<?php

namespace backend\assets;


use yii\web\AssetBundle;


/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets/velzon/';
    public $css = [
        [
            'href' => '/favicon.ico',
            'rel' => 'icon',
            'sizes' => '32x32',
        ],
        'libs/jquery-toast/jquery.toast.min.css',
        'css/bootstrap.min.css',
        'css/icons-velzon.min.css',
        'css/icons.min.css',
        'css/app.min.css',
        'css/custom.css',
    ];
    public $js = [
        'libs/jquery-toast/jquery.toast.min.js',
        'js/layout.js',
        'libs/node-waves/waves.min.js',
        'libs/feather-icons/feather.min.js',
        'js/lord-icon-2.1.0.js',
        'js/app.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap5\BootstrapPluginAsset',
    ];
}
