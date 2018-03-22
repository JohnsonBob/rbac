<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018/3/22
 * Time: 11:10
 */

namespace app\controllers\common;


use yii\web\Controller;

//所有控制器的基类 并且集成常用公用方法
class BaseController extends Controller
{

    /**
     * 统一获取post参数方法
     * @param $key
     * @param string $default
     */
    public function post($key, $default=""){

        return \Yii::$app->request->post($key,$default);
    }
    /**
     * 统一获取get参数方法
     * @param $key
     * @param string $default
     */
    protected function get($key, $default=""){
        return \Yii::$app->request->get($key, $default);
    }

    /**
     * 封装json的返回值 主要用于js ajax和后端的交互返回格式
     * @param array $date 数据区 数组
     * @param string $msg 此次操作的简单提示
     * @param int $code 状态码200表示成功 http请求成功状态码也是200
     */
    public function renderJSON($data= [], $msg = "ok", $code = 200){
        header('Content-type: application/json');//设置头部格式
        echo json_encode([
            "code" => $code,
            "msg" => $msg,
            "date" => $data,
            "req_id" => uniqid(),
        ]);
        //终止请求直接返回
        return \Yii::$app->end();
    }

}