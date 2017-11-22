<?php

namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;
class BookController extends BaseController
{
    public function __construct($id,  $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }
    //图书列表
    public function actionIndex ()
    {
        return $this->render('index');
    }
    //详情界面
    public function actionInfo ()
    {
        return $this->render('info');
    }
    //编辑图书信息
    public function actionSet ()
    {
        return $this->render('set');
    }
    //图片资源
    public function actionImages ()
    {
        return $this->render('images');
    }

    //图书分类的列表
    public function actionCat ()
    {
        return $this->render('cat');
    }

    //图书分类的添加、编辑
    public function actionCat_set ()
    {
        return $this->render('cat_set');
    }

}
