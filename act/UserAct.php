<?php
define(ALLOW,1);
include "../init.php";
//error_reporting(-1);
$user=new UserModel();
$data=$user->set_datas();
$data['regtime']=time();
if($data['password']==$_POST['repassword']){
$data['password']=md5($data['password']);
	$re=$user->add($data);
	if($re){
		$msg="成功";
	}else{
		$msg="失败";
	}
	
	include "../view/client/msg.html";
}
?>