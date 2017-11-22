<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/21 0021
 * Time: 上午 8:04
 */

namespace app\modules\web\controllers\common;


use app\common\components\BaseWebController;
use app\common\services\UrlService;
use app\models\User;

//web统一控制器中会做一些web独有的验证
//1.指定特定的布局文件
//2.进行登录验证
class BaseController extends BaseWebController
{
    protected $auth_cookie_name = 'mooc_book';

    public $allowAllAction = [
        'web/user/login',
        'web/user/logout'
    ];

    public $current_user = null;//当前登录人的信息

    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }

    //登录统一验证
    public function beforeAction($action)
    {
        //验证是否登录
        $is_login = $this->checkLoginSatus();

        if (in_array($action->getUniqueId(),$this->allowAllAction)){
            return true;
        }
        if (!$is_login) {
            if (\Yii::$app->request->isAjax) {
                $this -> renderJSON([],'未登录，请先登录~',-302);
            }else{
                $this->redirect(UrlService::buildWebUrl('/user/login'));
            }
            return false;
        }
        return true;
    }

    //目的：验证是否当前登录状态有效
    public function checkLoginSatus()
    {
        $auth_cookie = $this->getCookie($this->auth_cookie_name,'');

        if (!$auth_cookie){
             return false;
        }

        list($auth_token,$uid) = explode('#',$auth_cookie);
        if(!$auth_token || !$uid ){
            return false;
        }

        if(!preg_match("/^\d+$/",$uid)){
            return false;
        }

        $user_info = User::find()->where(['uid'=>$uid])->one();

        $this->current_user = $user_info;
        if (!$user_info){
            return false;
        }

        if ($auth_token != $this->geneAuthToken($user_info)) {
            return false;
        }

         return true;

    }

    //统一生成加密字段
    //加密字符串 + '#' + uid,加密字符串 =md5(login_name + login_pwd + login_salt)
    public function geneAuthToken($user_info){
        return  md5($user_info['login_name'].$user_info['login_pwd'].$user_info['login_salt']);
    }

    //设置登录态的方法
    public function setLoginsatus($user_info){
        $auth_token = $this->geneAuthToken($user_info);
        $this->setCookie($this->auth_cookie_name,$auth_token.'#'.$user_info['uid']);

    }
    //登录态删除
    public function removeLoginSatus(){
        $this->removeCookie($this->auth_cookie_name);
    }
}