<?php
defined("ALLOW")||exit("not allow!");
class Model{
	static protected $table=null;
	static protected $pri_key=null;
	protected $def_val=array();
	static protected $test_rule=array();
	protected $conn=null;
	public function __construct(){
$this->conn=Mysql::getins();
}
public function set_datas(){
	$sql="show columns from ".static::$table;
	$re=$this->conn->query($sql);
	while($m=mysqli_fetch_array($re)){
		$data[$m['Field']]=$_POST[$m['Field']];
	}
	return $data;
}
public function add($data){
return $this->conn->add($data,static::$table);
}
public function get($where=""){
$sql="select * from ".static::$table.$where;
return $this->conn->get_arr($sql);
}
public function del($id){
	$sql="delete from ".static::$table." where ".static::$pri_key."=".$id;
	return $this->conn->del($sql);
}
public function info($id){
	$sql="select * from ".static::$table." where ".static::$pri_key."=".$id;
	$arr=$this->conn->get_one($sql);
	return $arr;
}
public function update($arr,$where){
	return $this->conn->update($arr,static::$table,$where);
}
public function autotest($data){
if(empty(static::$test_rule)){
	return true;
}
foreach (static::$test_rule as $v) {
	if (array_key_exists($v['0'], $data)) {
		switch ($v[4]) {
			case 0:
				if($data[$v[0]]==null||$data[$v[0]]==""){
					return true;
				}
				return $this->_decide($data[$v[0]],$v[1],$v[2],$v[3]);
				break;
		    case 1:
				return $this->_decide($data[$v[0]],$v[1],$v[2],$v[3]);
				break;
		}		
	}
}
return true;
}
public function _decide($v1,$v2,$v3,$v4){
	switch ($v2) {
		case 'length':
			$v3=explode(",", $v3);
            if(!(strlen($v1)>=$v3[0]&&strlen($v1)<=$v3[1])){
            	return $v4;
            }else{
            	return true;
            }
			break;
	}
}
public function autofinish($data){
    foreach ($data as $key => $value) {
    	if ($value==null) {
    		$value=$this->def_val[$key];
    	}
    }
    return $data;
}
}
?>