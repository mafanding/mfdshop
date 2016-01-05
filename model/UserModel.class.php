<?php
defined("ALLOW")||exit("not allow!");
class UserModel extends Model {
	static protected $table="user";
	static protected $pri_key="user_id";
	 protected $def_val=array(
		"lastlogin"=>0
		);
	public function user_info($u,$p){
		$sql="select * from ".static::$table." where username='".$u."' and password='".md5($p)."'";
		$re=$this->conn->query($sql);
		if(mysqli_num_rows($re)==1){
			$time=time();
			$where=" where username='".$u."'";
			$this->update(array("lastlogin"=>$time),$where);
			$arr=mysqli_fetch_array($re);
			return $arr;
		}
		return false;
	} 
}
?>