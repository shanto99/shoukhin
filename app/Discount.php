<?php
namespace App;
class Discount{
	public $p_id = null;
	public $dis_percent = null;
	public $to_date = null;
	public function __construct($p_id, $dis_percent, $to_date){
		$this->p_id = $p_id;
		$this->dis_percent = $dis_percent;
		$this->to_date = $to_date;

	}
	public function do_discount(){
		$current_price = Product::where('product_id',$this->p_id)->first()->price;
        $discounted_price = $current_price - ceil(($this->dis_percent/100)*$current_price);
        $offer = new Offer();
        $offer->product_id = $this->p_id;
        $offer->start_at = date('Y-m-d');
        $offer->ends_at = $this->to_date;
        $offer->regular_price = $current_price;
        $offer->save();
        Product::where('product_id',$this->p_id)->update(['price' => $discounted_price, 'discount' => 1]);
        
	}
}