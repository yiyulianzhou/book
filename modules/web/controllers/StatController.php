<?php

namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;

class StatController extends BaseController
{
    public function __construct($id,  $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }
    //列表
    public function actionIndex ()
    {

        //统计信息首页
        return $this->render('index');
    }
    //产品统计
    public function actionProduct ()
    {
        return $this->render('product');
    }
    //会员统计
    public function actionMember ()
    {
        return $this->render('member');
    }
     //分享统计
     public function actionShare ()
     {
         return $this->render('share');
     }

}
