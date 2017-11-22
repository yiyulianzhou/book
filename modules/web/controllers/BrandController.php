<?php

namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;

class BrandController extends BaseController
{
    public function __construct($id,  $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }
    //详情界面
    public function actionInfo ()
    {
        return $this->render('info');
    }
    //编辑品牌信息
    public function actionSet ()
    {
        return $this->render('set');
    }
    //图片资源
    public function actionImages ()
    {
        return $this->render('images');
    }

}
