<?php
defined("ALLOW")||exit("not allow!");
class GoodsModel extends Model {
	static protected $table="goods";
	static protected $pri_key="goods_id";
	 protected $def_val=array(
        "cate_id"=>0,
        "brand_id"=>0,
        "shop_price"=>"0.00",
        "market_price"=>"0.00",
        "goods_number"=>1,
        "click_count"=>0,
        "goods_weight"=>"0.000",
        "goods_brief"=>"",
        "goods_desc"=>"",
        "is_on_sale"=>1,
        "is_delete"=>0,
        "is_best"=>0,
        "is_new"=>0,
        "is_hot"=>0,
        "last_update"=>0
		);
        /*
mode:  0:可以为空
       1:不能为空
        */
        static protected $test_rule=array(
         array("goods_name","length","1,30","名字不合法",1)
                );
	public function set_is_del($status,$id){
		return $this->update(array("is_delete"=>$status)," where goods_id=".$id);
	}
	public function set_goods_sn(){
		$sn=substr(md5($data['goods_name'].time()),5,15);
		return $sn;
	}
}
?>