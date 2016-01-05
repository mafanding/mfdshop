<?php
define(ALLOW,1);
include "../init.php";
$cate=new CateModel();
$data=$cate->set_datas();
$arr=$cate->get_anc($data['parent_id']);
if(in_array($data['parent_id'],$arr)||$data['parent_id']==$data['cate_id']){
	exit("修改失败");
}
$re=$cate->update($data,"where cate_id=".$data['cate_id']);
if($re){echo "修改成功";}else{echo "修改失败";}
?>