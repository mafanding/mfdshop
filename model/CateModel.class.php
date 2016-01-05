<?php
defined("ALLOW")||exit("not allow!");
class CateModel extends Model {
static protected $table="cate";
static protected $pri_key="cate_id";
public function set_tree($arr,$pid=0,$lve=0){
$tree=array();
foreach($arr as $v){
if($v['parent_id']==$pid){
$v['lve']=$lve;
$tree[]=$v;
$tree=array_merge($tree,$this->set_tree($arr,$v['cate_id'],$lve+1));
}
}
return $tree;
}
public function get_son($id){
	static $arr=array();
	$sql="select * from ".static::$table." where parent_id=".$id;
	$r=$this->conn->query($sql);
	while ($m=mysqli_fetch_array($r)) {
		$arr[]=$m;
		$this->get_son($m['cate_id']);
	}
	return $arr;
}
public function get_anc($id){
	static $arr=array();
	$sql="select * from ".static::$table." where cate_id=".$id;
	$pid=$this->conn->get_one($sql);
	if(!$pid){
		return $arr;
	}
	$arr[]=$pid;
    if($pid['parent_id']!=0){
    	$this->get_anc($pid['parent_id']);
    }
    return $arr;
}
public function can_del($id){
	$sql="select * from ".static::$table." where parent_id=".$id;
	$re=$this->conn->query($sql);
	$rows=mysqli_num_rows($re);
	if($rows>0){return false;}
	return true;
}
}
?>