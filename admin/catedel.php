<?php
define(ALLOW,1);
include "../init.php";
$id=$_GET['id'];
$cate=new CateModel();
$can=$cate->can_del($id);
if(!$can){
	exit("无法删除");
	}
$re=$cate->del($id);
if($re){echo "成功";}else{echo "失败";}

?>