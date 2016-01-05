<?php
define(ALLOW,1);
include "../init.php";
$goods=new GoodsModel();
$gid=isset($_GET['gid'])?$_GET['gid']:0;
$ginfo=$goods->info($gid);
if (isset($ginfo)&&!empty($ginfo)) {
	$cate=new CateModel();
	$anc=$cate->get_anc($ginfo['cate_id']);
	$anc=array_reverse($anc);
	if(!in_array($ginfo, $_SESSION['viewed'])) {
	$_SESSION['viewed'][]=$ginfo;
    }
	if (count($_SESSION['viewed'])>10) {
		array_shift($_SESSION['viewed']); 
	}
	include "../view/client/product_detail.html";
}else{
	$msg="商品不存在";
	include "../view/client/msg.html";
}

?>