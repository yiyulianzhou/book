<?php

namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;

class MemberController extends BaseController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }

    //会员列表
    public function actionIndex ()
    {
        return $this->render('index');
    }
    //详情界面
    public function actionInfo ()
    {
        return $this->render('info');
    }
    //设置会员信息
    public function actionSet ()
    {
        return $this->render('set');
    }

    //会员评论
    public function actionComment(){
        return $this->render('comment');
    }


}
