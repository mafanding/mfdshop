<?php
define(ALLOW,1);
include "../init.php";
$goods=new GoodsModel();
$arr=$goods->get(" where is_delete=0");
include "../view/admin/templates/goodslist.html";
?>