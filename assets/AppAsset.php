<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/style.css',
//        'css/app.css',
        'css/site.css',

        'css/app.css',
        'js/owl-carousel/assets/owl.carousel.min.css',
        'js/mCustomScrollbar/jquery.mCustomScrollbar.css',
        'css/style.css',
    ];
    public $js = [
        //'js/jquery-3.3.1.min.js',
        'js/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js',
        'js/owl-carousel/owl.carousel.min.js',
        'js/script.js',
        ];
    public $depends = [
//        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
