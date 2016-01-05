<?php
define(ALLOW,1);
include "../init.php";
$cate=new CateModel();
$data=$cate->set_datas();
$re=$cate->add($data);
if($re){
echo "成功";
}else{
echo "失败";
}
?>