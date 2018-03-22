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
use app\services\UrlService;
use yii\web\Cookie;

class UserController extends BaseController
{
    public function actionVlogin(){
        $uid = $this->get('uid',0);
        if(!$uid){
            return UrlService::buildUrl('/');
        }
        $user_info = User::find()->where(['id'=> $uid])->one();
        if($user_info){
            return UrlService::buildUrl('/');
        }
        //用户信息存在 cookie保存用户的登录状态 需要加密cookie 规则user_anth_token + "#" + uid
        $user_anth_token = md5($user_info['id'].$user_info['name'].$user_info['email'].$_SERVER('HTTP_USER_AGENT'));
        $cookie_target = \Yii::$app->request->cookies;
        $cookie_target->add(new Cookie([
            'name' => "immoc_888",
            "value" => $user_anth_token.'#'.$user_info['id'],
        ]));
        return $this->redirect(UrlService::buildUrl('/'));
    }
}