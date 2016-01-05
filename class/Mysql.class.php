<?php
defined("ALLOW")||exit("not allow!");
class Mysql extends Db {
private $conn=null;
private static $ins=null;
private $conf=array();
protected function __construct(){
$this->conf=Config::getIns();
$this->conn=mysqli_connect($this->conf->db_host,$this->conf->db_user,$this->conf->db_pwd,$this->conf->db_name);
$this->query("set names utf8");
}
public static function getins(){
if(self::$ins instanceof self){
return self::$ins;
}
self::$ins=new self();
return self::$ins;
}
public function query($sql){
  mysqli_query($this->conn,"set names utf8");
Log::report($sql);
return mysqli_query($this->conn,$sql);
}
public function add($data,$table){
foreach($data as $k=>$v){
$c.=$k.",";
$d.=$v."','";
}
$c=substr($c,0,-1);
$d=substr($d,0,-3);
$sql="insert into ".$table." (".$c.") values ('".$d."')";
return $this->query($sql);
}
public function get_arr($sql){
$re=$this->query($sql);
while($r=mysqli_fetch_array($re)){
$arr[]=$r;
}
return $arr;
}
public function del($sql){
	$this->query($sql);
	$re=mysqli_affected_rows($this->conn);
	if($re>0){
		return true;
	}
	return false;
}
public function get_one($sql){
	$re=$this->query($sql);
	$arr=mysqli_fetch_array($re);
	return $arr;
}
public function update($arr,$table,$where=''){
      foreach($arr as $k=>$v){
      $data_key[]=$k;
      $data_value[]=$v;
      }
     $sql="update ".$table." set ";
     for($i=0;$i<count($arr);$i++){
     	$sql.=$data_key[$i]."='".$data_value[$i]."',";
     }
     $sql=substr($sql,0,-1);
     $sql=$sql.$where;
     return $this->query($sql);
}
public function close(){
return mysqli_close($this->conn);
}
}
?>