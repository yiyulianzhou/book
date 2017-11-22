<?php

namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;

class DashboardController extends BaseController
{
    //仪表盘列表
    public function actionIndex ()
    {
        $this->layout = 'main';
        return $this->render('index');
    }


}
