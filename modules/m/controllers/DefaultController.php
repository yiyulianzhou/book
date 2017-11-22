<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

//品牌首页
class DefaultController extends Controller
{
    //首页
    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('index');
    }
}
