<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/19 0019
 * Time: 上午 7:31
 */

namespace app\common\services;
use yii\helpers\Url;
 //构建链接
class UrlService {
    //构建会员端所有链接
    public static function buildMUrl( $path,$params = [] ){
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([ $path ],$params));
        return $domain_config['m'] .$path;
    }
    //构建Web端所有链接
    public static function buildWebUrl( $path,$params = [] ){
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([ $path ],$params));
        return $domain_config['web'] .$path;
    }
    //构建默认链接
    public static function buildWwwUrl( $path,$params = [] ){
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([ $path ],$params));
        return $domain_config['www'] .$path;
    }
    //构建空链接
    public static function buildNullUrl(){
        return "javascript:void(0);";
    }

}