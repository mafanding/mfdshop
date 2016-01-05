<?php
define(ALLOW,1);
include "../init.php";
if(isset($_GET['act'])&&$_GET['act']==show){
$goods=new GoodsModel();
$arr=$goods->get(" where is_delete=1");
include "../view/admin/templates/goodstrashlist.html";
}else{
$goods=new GoodsModel();
$id=$_GET['id']+0;
$re=$goods->set_is_del(1,$id);
if($re){
	echo "删除成功";
}else{
	echo "删除失败";
}
}
?>