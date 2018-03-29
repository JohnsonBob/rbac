<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018-3-29
 * Time: 23:23
 */

namespace app\controllers;


use app\controllers\common\BaseController;

class DefaultController extends BaseController
{
    public function actionIndex(){
        return $this->render('index');
    }
}