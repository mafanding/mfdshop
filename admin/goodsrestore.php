<?php
define(ALLOW,1);
include "../init.php";
$goods=new GoodsModel();
$id=$_GET['id']+0;
$re=$goods->set_is_del(0,$id);
if($re){
	echo "还原成功";
}else{
	echo "还原失败";
}
?>