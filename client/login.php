<?php
define(ALLOW,1);
include "../init.php";

if (isset($_POST['is_login'])&&$_POST['is_login']=='y') {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$user=new UserModel();
	$re=$user->user_info($username,$password);
	if($re){
		$_SESSION['username']=$_POST['username'];
		$_SESSION['user_id']=$re['user_id'];
		setcookie("username",$_SESSION['username'],time()+3600*7*24);
		$shopcart=ShopCart::initCart($_SESSION['user_id']);
	    $msg="登入成功";
    }else{
    	$msg="登入失败";
    }
    include "../view/client/msg.html";
}else{
include "../view/client/login.html";
}
?>