<?php
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class Select2Asset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/select2';
    public $css = [
        'select2.min.css',
    ];
    public $js = [
        'select2.min.js'
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];

    
}
