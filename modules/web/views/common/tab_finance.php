<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/23 0023
 * Time: 上午 7:23
 */
use \app\common\services\UrlService;
$tab_list = [
    'index'=>[
        'title'=> '订单列表',
        'url' =>'/finance/index'
    ],
    'pay_info'=>[
        'title'=> '财务流水',
        'url' => '/finance/pay_info'
    ]
];
?>
<div class="row  border-bottom">
    <div class="col-lg-12">
        <div class="tab_title">
            <ul class="nav nav-pills">
                <?php foreach($tab_list as $_current=>$_item):?>
                    <li  <?php if($current == $_current): echo "class = 'current'"; endif;?>  >
                        <a href="<?= UrlService::buildWebUrl($_item['url'])?>"><?=$_item['title']?></a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
  </div>