<?php
define(ALLOW,1);
include "../init.php";
//error_reporting(-1);
if (isset($_SESSION['username'])) {
$ShopCart=ShopCart::initCart($_SESSION['user_id']);
$shopcart=$ShopCart->getcartinfo();
if(isset($_GET['act'])){
	switch ($_GET['act']) {
		case 'clearOne':
			$ShopCart->clearOne($_GET['gid']);
			break;
		case 'clearAll':
		    $ShopCart->clearAll();
		    break;
	}
}
include "../view/client/shopping_cart.html";
}else{
	$msg="请先登入";
include "../view/client/msg.html";
}
?>