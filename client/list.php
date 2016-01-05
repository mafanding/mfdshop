<?php
define(ALLOW,1);
include "../init.php";

$cate=new CateModel();
$arr=$cate->get();
$catetree=$cate->set_tree($arr,0,0);
$cid=isset($_GET['cid'])?$_GET['cid']:0;
if ($cid>0) {
	$anc=$cate->get_anc($cid);
	$anc=array_reverse($anc);
	$son=$cate->get_son($cid);
    $where=" where cate_id='".$cid."'";
    if (!empty($son)) {
    	foreach ($son as $key => $v) {
    		$where.="or cate_id='".$v['cate_id']."'";
    	}
    }
    $goods=new GoodsModel();
    $goodslist=$goods->get($where);
    //print_r($goodslist);
}
$view=$_SESSION['viewed'];
$view=array_reverse($view);

//print_r($son);
//print_r($catetree);
include "../view/client/list.html";
?>