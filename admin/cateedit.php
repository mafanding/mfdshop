<?php
define(ALLOW,1);
include "../init.php";
$id=$_GET['id'];
$cate=new CateModel();
$data=$cate->info($id);
$arr=$cate->get();
$arr=$cate->set_tree($arr);
include "../view/admin/templates/cateedit.html";
?>