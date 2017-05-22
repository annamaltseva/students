<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css',
        'https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css'
];
    public $js = [
        'http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js',
        'http://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
