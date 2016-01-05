<?php
define(ALLOW,1);
include "../init.php";
$cate=new CateModel();
$arr=$cate->get();
$arr=$cate->set_tree($arr);
//print_r($arr);
include "../view/admin/templates/cateadd.html";
?>