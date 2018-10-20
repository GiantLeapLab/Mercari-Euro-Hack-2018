<?php
/**
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ScanAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/scan.css',
    ];
    public $js = [
        'js/bundle.min.js',
        'js/vendor.min.js',
    ];
    public $depends = [
    ];
}
