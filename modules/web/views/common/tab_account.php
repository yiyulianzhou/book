<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/22 0022
 * Time: 下午 7:38
 */
use \app\common\services\UrlService;
    $tab_list = [
        'index'=>[
            'title'=> '账户列表',
            'url' =>'/account/index'
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