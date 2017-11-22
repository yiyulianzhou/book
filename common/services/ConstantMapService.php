<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/22 0022
 * Time: 下午 5:02
 */

namespace app\common\services;


class ConstantMapService
{
    public static $status_default = -1;
    public static $status_mapping = [
      1=>'正常',
      0=>'已删除'
  ];
}