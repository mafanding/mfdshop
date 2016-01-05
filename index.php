<?php
define(ALLOW,1);
include "init.php";
error_reporting(-1);
$file=$_FILES['txt'];
$up=new File();
$re=$up->upload($file['name'],$file['size'],$file['tmp_name']);
if($re){echo "ok";}else{echo "fail";}
?>