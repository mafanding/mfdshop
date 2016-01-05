<?php
define(ALLOW,1);
include "../init.php";

$goods=new GoodsModel();
$where=" where is_on_sale=1 and is_delete=0 and is_new=1 order by rand() limit 5";
$new=$goods->get($where);
include "../view/client/index.html";
?>