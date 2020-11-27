<?php

namespace app\assets;

use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{
    public $sourcePath = '@app/vendor/almasaeed2010/adminlte';

    public $css = [
        "dist/css/AdminLTE.min.css",
        "dist/css/skins/_all-skins.min.css",
        "plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css",
        "bower_components/select2/dist/css/select2.min.css"
    ];

    public $js = [
        "dist/js/adminlte.min.js",
        "bower_components/moment/moment.js",
        "bower_components/moment/locale/ru.js",
        "bower_components/select2/dist/js/select2.full.min.js",
        "plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
