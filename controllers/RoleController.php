<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018/3/22
 * Time: 15:43
 */

namespace app\controllers;


use app\controllers\common\BaseController;
use app\models\Role;
use app\models\User;
use yii\web\Controller;
use app\services\UrlService;
use yii\web\Cookie;

class RoleController extends BaseController
{
    /**
     * 角色列表页面
     * @return string
     */
    public function actionIndex(){
        $view = \Yii::$app->view;
        $view->params['list'] = [];
        return $this->render('index');
    }

    /**
     *添加角色页面
     * get展示界面
     * post处理添加动作
     */
    public function actionSet(){
        if(\Yii::$app->request->isGet){
            return $this->render('set');
        }
        $name = $this->post('name');
        if(!name){
            return $this->renderAjax([],'请输入合法的角色名称',-1);
        }
        //查询是否存在角色名称相等的记录
        $role_info = Role::find()->where(['name' =>$name])->one();
        if($role_info){
            return $this->renderAjax([],'该角色名称已经存在，请输入其他角色名称!',-1);
        }

        $role_mode = new Role();
        $role_mode->name = $name;

    }
}