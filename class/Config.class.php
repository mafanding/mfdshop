<?php
defined("ALLOW")||exit("not allow!");
class Config{
protected static $ins=null;
protected $data;
final protected function __construct(){
include dirname(__DIR__)."/config.php";
$this->data=$cfg;
}
final protected function __clone(){}
public static function getIns(){
if(!self::$ins instanceof self){
self::$ins=new self();
}
return self::$ins;
}
public function __get($k){
if(array_key_exists($k,$this->data)){
return $this->data[$k];
}else{
return null;
}
}
public function __set($k,$v){
$this->data[$k]=$v;
}
}
$conf=Config::getIns();
?>