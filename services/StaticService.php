<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018/3/21
 * Time: 22:04
 */

namespace app\services;



//同意管理链接 并规范书写
class StaticService
{
    /**
     * 使用YII统一的方法加载js或者css
     * @param $type
     * @param $path
     * @param $depend
     */
    public static function includeAppStatic($type, $path, $depend){
        //版本号是为了解决浏览器缓存问题
        $release_version = defined("RELEASE_VERSION") ? RELEASE_VERSION :'20150731141600';
        if(stripos($path,"?") !== false){
            $path = $path."&version={$release_version}";
        }else{
            $path = $path."?version={$release_version}";
        }
        if($type == "css"){
            \Yii::$app->getView()->registerCssFile($path,['depends' => $depend]);
        }if($type == "js"){
            \Yii::$app->getView()->registerJsFile($path,['depends' => $depend]);
        }

    }

    /**
     *引入js业务文件
     */
    public static function includeAppJsStatic($path, $depend){
        self::includeAppStatic("js",$path, $depend);
    }

    /**
     *引入css业务文件
     */
    public static function includeAppCssStatic($path, $depend){
        self::includeAppStatic("css",$path, $depend);
    }
}