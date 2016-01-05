<?php
defined("ALLOW")||exit("not allow!");
define("ROOT",__DIR__."/");
include ROOT."function/function.php";
/*include ROOT."class/config.class.php";
include ROOT."class/log.class.php";
include ROOT."class/db.class.php";
include ROOT."model/TestModel.php";*/
function __autoload($class){
if(stripos($class,"model")===false){
require(ROOT."class/".$class.".class.php");
}else{
require(ROOT."model/".$class.".class.php");
}
}
$_GET=_addslashes($_GET);
$_POST=_addslashes($_POST);
$_COOKIE=_addslashes($_COOKIE);
session_start();
define("DEBUG",$conf->debug);
if(DEBUG==1){
error_reporting(-1);
}else{
error_reporting(0);
}

?>