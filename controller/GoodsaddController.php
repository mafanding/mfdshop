<?php
define(ALLOW,1);
include "../init.php";
//error_reporting(-1);
$goods=new GoodsModel();
$data=$goods->set_datas();
$data['goods_weight']=$data['goods_weight']*$_POST['weight_unit'];
$data['add_time']=time();
if($data['goods_sn']==""){
	$data['goods_sn']=$goods->set_goods_sn();
}
$upload=new File();
$file=$_FILES['ori_img'];
$dir=$upload->upload($file['name'],$file['size'],$file['tmp_name']);
$data['ori_img']=$dir;
$image=new Image();
$dir=ROOT.$dir;
$save=dirname($dir)."/goods_".basename($dir);
$image->thumbnail($dir,300,400,$save);
$data['goods_img']=str_replace(ROOT, "", $save);
$save=dirname($dir)."/thumb_".basename($dir);
$image->thumbnail($dir,160,220,$save);
$data['thumb_img']=str_replace(ROOT, "", $save);
$re=$goods->add($data);
if ($re) {
	echo "成功";
}else{
	echo "失败";
}
?>