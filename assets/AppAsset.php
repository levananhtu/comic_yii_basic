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
//        'css/site.css',
        'assets/icon/icofont/css/icofont.css',
        'assets/icon/simple-line-icons/css/simple-line-icons.css',
        'bower_components/bootstrap/css/bootstrap.min.css',
        'bower_components/chartist/css/chartist.css',
        'assets/css/svg-weather.css',
        'assets/css/main.css',
        'assets/css/responsive.css',
        'assets/css/color/color-4.min.css',
    ];
    public $js = [
        'bower_components/jquery/js/jquery.min.js',
        'bower_components/jquery-ui/js/jquery-ui.min.js',
        'bower_components/popper.js/js/popper.min.js',
        'bower_components/bootstrap/js/bootstrap.min.js',
        'assets/plugins//waves/js/waves.min.js',
        'bower_components/jquery-slimscroll/js/jquery.slimscroll.js',
        'assets/plugins//jquery.nicescroll/js/jquery.nicescroll.min.js',
        'bower_components/classie/js/classie.js',
        'assets/plugins//notification/js/bootstrap-growl.min.js',
        'bower_components/jquery-sparkline/js/jquery.sparkline.js',
        'bower_components/waypoints/js/jquery.waypoints.min.js',
        'assets/plugins//countdown/js/jquery.counterup.js',
        'assets/js/main.min.js',
        'assets/pages/dashboard.js',
        'assets/pages/elements.js',
        'assets/js/menu-horizontal.min.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
