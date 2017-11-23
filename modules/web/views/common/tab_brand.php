<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/23 0023
 * Time: 上午 7:14
 */
use \app\common\services\UrlService;
$tab_list = [
    'info'=>[
        'title'=> '品牌信息',
        'url' =>'/brand/info'
    ],
    'images'=>[
        'title'=> '品牌相册',
        'url' => '/brand/images'
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