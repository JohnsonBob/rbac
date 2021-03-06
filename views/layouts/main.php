<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use \app\services\UrlService;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <!--导航条-->
    <nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">RBAC</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" >
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">首页</a></li>
                </ul>
                <?php if(isset($this->params['current_user'])): ?>
                <p class="navbar-text navbar-right">Hi,<?=$this->params['current_user']['name']?></p>
                <?php endif?>
            </div>
        </div>
    </nav>

<!--    菜单栏和内容区域-->
    <div class="container-fluid"style="margin-top: 60px">
        <div class="col-sm-2 col-md-2  sidebar">
            <!--            菜单栏区域-->
            <ul class="nav nav-sidebar">
                <li >演示权限界面</li>
                <li><a href="<?=UrlService::buildUrl("/test/page2");?>">测试界面一</a></li>
                <li><a href="<?=UrlService::buildUrl("/test/page2");?>">测试页面二</a></li>
                <li><a href="#">测试界面三</a></li>
                <li><a href="#">测试界面四</a></li>

                <li >系统设置</li>
                <li><a href="#">用户管理</a></li>
                <li><a href="<?=UrlService::buildUrl('/role/index');?>">角色管理</a></li>
                <li><a href="#">权限管理</a></li>
            </ul>
        </div>

        <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-6 col-lg-offset-2 sidebar">
            <!--            内容区域-->
            <?=$content;?>

            <hr/>
            <footer>
                <p class="pull-left">@Johnson RBAC</p>
                <p class="pull-right">Power By 慕课 www.imooc.com</p>
            </footer>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
