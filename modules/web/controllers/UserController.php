<?php

namespace app\modules\web\controllers;


use app\common\services\UrlService;
use app\models\User;
use app\modules\web\controllers\common\BaseController;

class UserController extends BaseController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }

    //登录界面
    public function actionLogin ()
    {

        //如果是get请求，展示登录页面
        if (\Yii::$app->request->isGet) {
            $this->layout = 'user';
            return $this->render('login');
        }
        //如果是post请求，登录逻辑的处理
        $login_name = trim($this->post('login_name',''));
        $login_pwd = trim($this->post('login_pwd',''));
        if (!$login_name || !$login_pwd) {
            return $this->renderJS('请输入正确的用户名和密码！_1',UrlService::buildWebUrl('/user/login'));
        }
        //从用户表获取logoin_name = $login_name，用户信息是否存在
        $user_info = User::find()->where(['login_name'=>$login_name])->one();
        if (!$user_info) {
            return $this->renderJS('请输入正确的用户名和密码！_2',UrlService::buildWebUrl('/user/login'));
        }
        //验证密码
        //密码加密算法 = md5(login_pwd+md5(login_salt))

        if (!$user_info->verifyPassword($login_pwd)) {
            return $this->renderJS('请输入正确的用户名和密码！_3',UrlService::buildWebUrl('/user/login'));
        }
        //保存用户的登录状态
        //cookie进行保存用户的登录状态
        //加密字符串 + '#' + uid,加密字符串 =md5(login_name + login_pwd + login_salt)
        $this->setLoginsatus($user_info);

        return $this->renderJS('登录成功！',UrlService::buildWebUrl('/dashboard/index'));

    }
    //编辑当前登录人信息
    public function actionEdit ()
    {
        if (\Yii::$app->request->isGet) {
            //获取当前登录人的信息
            return $this->render('edit',['user_info'=>$this->current_user]);
        }
        $nickname = trim($this->post('nickname',''));
        $email = trim($this->post('email',''));
        if( mb_strlen( $nickname,"utf-8" ) < 1 ){
            return $this->renderJSON( [],"请输入符合规范的姓名~~",-1 );
        }

        if( mb_strlen( $email,"utf-8" ) < 1 ){
            return $this->renderJSON( [],"请输入符合规范的邮箱地址~~",-1 );
        }

        $user_info = $this->current_user;

        $user_info->nickname = $nickname;
        $user_info->email = $email;
        $user_info->updated_time = date("Y-m-d H:i:s");
        $user_info->update(0);

        return $this->renderJSON([],"操作成功~~");

    }
    //编辑当前登录人信息
    public function actionReset_pwd ()
    {
        if (\Yii::$app->request->isGet){
            return $this->render('reset_pwd',['user_info'=>$this->current_user]);
        }

        $old_password = trim($this->post('old_password',''));
        $new_password = trim($this->post('new_password',''));
        if (mb_strlen($old_password,'utf-8') < 1) {
            return $this->renderJSON( [],"请输入原密码！",-1 );
        }
        if (mb_strlen($new_password,'utf-8') < 6) {
            return $this->renderJSON( [],"请输入6位数新密码！",-1 );
        }
        if ($old_password == $new_password) {
            return $this->renderJSON([],'请重新输入一个吧，新密码不能和原密码相同!',-1);

        }
        //判断原密码是否正确
        $user_info = $this->current_user;
        if (!$user_info->verifyPassword ($old_password)){
            $this->renderJSON([],'请检查原密码是否正确!',-1);
        }
        $user_info->setPassword($new_password);
        $user_info->updated_time = date('Y-m-d H:i:s');
        $user_info->update( 0 );
        $this->setLoginsatus($user_info);
        return $this->renderJSON([],'重置密码成功！');

    }

    //退出登录方法
    public function actionLogout ()
    {
        $this->removeLoginSatus();
        $this->redirect(UrlService::buildWebUrl('/user/login'));
    }

}
