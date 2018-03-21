<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018/3/21
 * Time: 22:04
 */

namespace app\services;


use yii\helpers\Url;

//同意管理链接 并规范书写
class UrlService
{
    /**
     * 返回一个 内部链接
     * @param $uri
     * @param array $param
     * @return string
     */
    public static function buildUrl($uri, $param=[]){

        return Url::toRoute(array_merge([$uri],$param));
    }

    /**
     * 返回一个 空连接
     * @return string
     */
    public static function buildNullUrl() {

        return "javascript:void(0)";
    }
}