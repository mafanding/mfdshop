<?php
defined("ALLOW")||exit("not allow!");
class TestModel extends Model {
public function gain($sql){
$r=$this->conn->query($sql);
$i=0;
$arr=array();
while($m=mysqli_fetch_array($r)){
$arr[$i]['title']=$m['title'];
$arr[$i]['no']=$m['no'];
$i++;
}
return $arr;
}
}
?>