<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

/**
 * 商品 controller for the `m` module
 */
class ProductController extends Controller
{
    public function __construct($id,  $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }

    /**
     * 商品列表页
     */
    public function actionIndex ()
    {
        return $this->render('index');
    }
    //商品详情页
    public function actionInfo ()
    {
        return $this->render('info');
    }

    //下单页面
    public function actionOrder ()
    {
        return $this->render('order');
    }

}
