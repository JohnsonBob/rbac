<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018/3/22
 * Time: 11:10
 */

namespace app\controllers\common;


use app\models\User;
use yii\web\Controller;
use yii\web\Cookie;
use app\services\UrlService;

//所有控制器的基类 并且集成常用公用方法
class BaseController extends Controller
{
    protected $auth_cookie_name = "immoc_888";
    protected $current_user = null;//当前登录人信息
    protected $allowAllAction = [
        'user/login',
        'user/vlogin'
    ];

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

    //用户相关信息生成加密校验码函数
    public function createAuthToken($uid,$name,$email,$user_agent){
        return md5($uid.$name.$email.$user_agent);
    }

    /**
     *  验证登录是否有效
     */
    public function checkLoginStasus(){
        $request = \Yii::$app->request;
        $cookies = $request->cookies;
        $auth_cookies = $cookies->get($this->auth_cookie_name);
        if(!$auth_cookies){
            return false;
        }
        list($auth_token,$uid) = explode('#',$auth_cookies);
        if(!$auth_token || !$uid){
            return false;
        }
        if( $uid && preg_match("/^\d+$/",$uid) ){
            $userinfo = User::findOne([ 'id' => $uid ] );
            if(!$userinfo){
                return false;
            }
            if($auth_token != $this->createAuthToken($userinfo['id'],$userinfo['name'],$userinfo['email'],$_SERVER['HTTP_USER_AGENT'])){
                return false;
            }
//            $this->current_user = $userinfo;
//            $view = \Yii::$app->view;
//            $view->params['current_user'] = $userinfo;
            return true;
        }
        return false;
    }

    //设置用户登录cookies
    public function createLoginStatus($userinfo)
    {
        $user_anth_token = $this->createAuthToken($userinfo['id'],$userinfo['name'],$userinfo['email'],$_SERVER['HTTP_USER_AGENT']);
        //var_dump($user_anth_token); die;
        $cookie_target = \Yii::$app->response->cookies;
        $cookie_target->add(new Cookie([
            'name' => $this->auth_cookie_name,
            "value" => $user_anth_token.'#'.$userinfo['id'],
        ]));
    }

    /**
     * 本系统所有的界面都需要在登录之后才能访问
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $loginStatus = $this->checkLoginStasus();
        //var_dump($loginStatus);die;
        if ( !$loginStatus && !in_array( $action->uniqueId,$this->allowAllAction )  ) {
            //var_dump($action->uniqueId);die();
            if(\Yii::$app->request->isAjax){
                $this->renderJSON([],"未登录,请返回用户中心",-302);
            }else{
                $this->redirect( UrlService::buildUrl("/user/login") );//返回到登录页面
            }
            return false;
        }
        return true;
       // return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

}