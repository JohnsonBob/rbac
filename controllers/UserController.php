<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018/3/22
 * Time: 15:43
 */

namespace app\controllers;


use app\controllers\common\BaseController;
use app\models\User;
use yii\web\Controller;
use app\services\UrlService;
use yii\web\Cookie;

class UserController extends BaseController
{
    public function actionVlogin(){
        $uid = $this->get('uid',0);
        if(!$uid){
            return $this->redirect(UrlService::buildUrl('/'));
        }
        $user_info = User::find()->where(['id'=> $uid])->one();
        if(!$user_info){
            return $this->redirect(UrlService::buildUrl('/'));
        }
        //用户信息存在 cookie保存用户的登录状态 需要加密cookie 规则user_anth_token + "#" + uid
        $this->createLoginStatus($user_info);
        return $this->redirect(UrlService::buildUrl('/'));
    }
    public function actionLogin(){
        return $this->render("login",[
            'host' => $_SERVER['HTTP_HOST']
        ]);
    }
}