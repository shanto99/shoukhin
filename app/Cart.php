<?php

namespace App;
use App\Usergrab;

class Cart
{
    public $items = null;
    
    public $quantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->quantity = $oldCart->quantity;
            $this->totalPrice = $oldCart->totalPrice;


        }

    }
    public function add($item, $id){
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item,'image' => $item->image];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;

        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->quantity++;
        $this->totalPrice += $item->price;
    }
    public function remove_one($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->quantity--;
        $this->totalPrice -= $this->items[$id]['item']['price'];

        if($this->items[$id]['qty']<=0){
            unset($this->items[$id]);
        }
    }
    public function remove_all($id){
        $this->quantity -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
    public function get_orders(){
        
    }
}
