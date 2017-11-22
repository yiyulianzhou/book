<?php

namespace app\controllers;
use app\common\components\BaseWebController;
use app\common\services\applog\ApplogService;
use Codeception\Module\Yii2;
use Yii;
use yii\log\FileTarget;
class ErrorController extends BaseWebController
{
    public function actionError ()
    {
        //记录错误信息到文件和数据库
        $err_msg = '';
        $error = \Yii::$app->errorHandler->exception; 
        if ($error) {
            $file = $error->getFile();
            $line = $error->getLine();
            $message = $error->getMessage();
            $code = $error->getCode();
            $log = new FileTarget();
            $log->logFile = \Yii::$app->getRuntimePath() . "/logs/err.log";

            $err_msg = $message. "[file:{$file}][line:{$line}][url:{$_SERVER['REQUEST_URI']}][POST_DATA:]" .http_build_query($_POST). "]";
            $log->messages[] = [
            $err_msg,
            1,
            'application',
            microtime(true)
            ];
            $log->export();
            //todo 写入到数据库

            ApplogService::addErrorLog(\Yii::$app->id,$err_msg);
        }
        return $this->render('error',['err_msg'=>$err_msg]);
        
    }
}
