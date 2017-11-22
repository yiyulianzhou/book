<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

//支付控制器
class PayController extends Controller
{
    //购买
    public function actionBuy()
    {
        $this->layout = 'main';
        return $this->render('buy');
    }
}
