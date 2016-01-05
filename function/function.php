<?php
defined("ALLOW")||exit("not allow!");
function _addslashes($arr){
if(is_array($arr)){
foreach($arr as $k=>$v){
if(is_array($v)){
$arr[$k]=_addslashes($v);
}else{
$arr[$k]=addslashes($v);
}
}
}else{
$arr=addslashes($arr);
}
return $arr;
}
?>