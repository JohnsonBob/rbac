<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use app\services\UrlService;
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
/*    public $css = [
        'bootstrap/css/bootstrap.css',
    ];
    public $js = [
         'jquery/jquery-3.3.1.min.js',
         'bootstrap/js/bootstrap.js',
    ];*/
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    /**
     * 重写父类的registerAssetFiles方法
     * @param \yii\web\View $view
     */
    public function registerAssetFiles($view){
        //加一个版本号，目的：是浏览器获取最新的css和js文件
       /* $release = "20180321";
        $this->css = [
            "bootstrap/css/bootstrap.min.css?v={this->$release}",
            "css/app.css",
        ];
        $this->js = [
            'jquery/jquery-3.3.1.min.js',
            'bootstrap/js/bootstrap.js',
        ];
        parent::registerAssetFiles($view);*/

         $release = "20180321";
        $this->css = [
            UrlService::buildUrl("bootstrap/css/bootstrap.min.css?",['v' =>$release]),
            UrlService::buildUrl("css/app.css"),
        ];
        $this->js = [
            UrlService::buildUrl('jquery/jquery-3.3.1.min.js'),
            UrlService::buildUrl('bootstrap/js/bootstrap.js'),
        ];
        parent::registerAssetFiles($view);
    }
}
