<?php
defined("ALLOW")||exit("not allow!");
class ShopCart{
	protected static $ins=null;
	protected static $cartinfo=array();
	protected static $table="shopcart";
	protected static $conn=null;
	protected static $uid=null;
	final protected function __construct(){
		self::$conn=Mysql::getins();
	}
	final protected function __clone(){
	}
	protected static function getIns($uid){
		if (!(self::$ins instanceof self)) {
			self::$ins=new self();
			self::$uid=$uid;
		}
		return self::$ins;
	}
	protected static function isUser(){
		$sql="select * from user where user_id='".self::$uid."'";
		$re=self::$conn->get_one($sql);
		if($re){
			return true;
		}
		return false;
	}
	public static function initCart($uid){
		if (!(self::$ins instanceof self)) {
			self::getIns($uid);
		}
		if (!self::isUser()) {
			return false;
		}
		$sql="select a.goods_id,a.num,b.shop_price,b.goods_name,b.shop_price,b.market_price,b.thumb_img from ".self::$table." as a,goods as b where a.user_id='".self::$uid."' and a.goods_id=b.goods_id";
		self::$cartinfo=self::$conn->get_arr($sql);
		return self::$ins;
	}
	protected function update($gid,$num){
		$arr=array("num"=>$num);
		$where=" where user_id='".self::$uid."' and goods_id='".$gid."'";
		self::$conn->update($arr,self::$table,$where);
	}
	protected function add($gid,$num){
		$data=array("goods_id"=>$gid,"num"=>$num,"user_id"=>self::$uid);
		self::$conn->add($data,self::$table);
	}
	public function inputNum($gid,$num){
		foreach (self::$cartinfo as $k=>$v) {
			if ($gid==$v['goods_id']) {
				$v['num']=$num;
				if($num<1){
					$this->clearOne($v['goods_id']);
				}else{
					$this->update($gid,$num);
				}
				return self::$cartinfo;
			}
	}
		if ($num<1) {
			return self::$cartinfo;
		}
		$sql="select shop_price from goods where goods_id='".$gid."'";
		$price=self::$conn->get_one($sql);
		self::$cartinfo[]=array("goods_id"=>$gid,"num"=>$num,"shop_price"=>$price['shop_price']);
		$this->add($gid,$num);
		return self::$cartinfo;
	}
	public function addOne($gid){
		foreach (self::$cartinfo as $v) {
			if ($gid==$v['goods_id']) {
				$v['num']++;
				$this->update($gid,$v['num']);
				return self::$cartinfo;
			}
		}
		$sql="select shop_price from goods where goods_id='".$gid."'";
		$price=self::$conn->get_one($sql);
		self::$cartinfo[]=array("goods_id"=>$gid,"num"=>1,"shop_price"=>$price['shop_price']);
		$this->add($gid,1);
		return self::$cartinfo;
	}
	public function delOne($gid){
		foreach (self::$cartinfo as $k=>$v) {
			if ($gid==$v['goods_id']) {
				$v['num']--;
				if($v['num']<1){
					$this->clearOne($v['goods_id']);
				}else{
					$this->update($gid,$v['num']);
				}
				return self::$cartinfo;
			}
		}
		return false;
	}
	public function clearOne($gid){
		foreach (self::$cartinfo as $k => $v) {
			if ($gid==$v['goods_id']) {
				$tmp=$k;
				break;
			}
		}
		array_splice(self::$cartinfo, $tmp,1);
		$sql="delete from ".self::$table." where goods_id='".$gid."' and user_id='".self::$uid."'";
		self::$conn->del($sql);
	}
	public function clearAll(){
		self::$cartinfo=array();
		$sql="delete from ".self::$table." where user_id='".self::$uid."'";
		self::$conn->del($sql);
	}
	public function getcartinfo(){
		return self::$cartinfo;
	}
}
?>