<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018/3/27
 * Time: 23:40
 */

namespace app\controllers;


use app\controllers\common\BaseController;

class TestController extends BaseController{
    /**
     *测试界面1
     */
    public function actionPage1(){
        return $this->render('page1');
    }

    /**
     *测试界面2
     */
    public function actionPage2(){
        return $this->render('page1');

    }
    /**
     *测试界面3
     */
    public function actionPage3(){
        return $this->render('page3');

    }
    /**
     *测试界面4
     */
    public function actionPage4(){
        return $this->render('page4');

    }
}