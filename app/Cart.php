<?php

namespace App;


class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    // the old cart
    public function __construct($oldCart) {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    // add new item
    public function add($item, $id) {
        $storedItem = ['qty'=>0, 'price'=>$item->product_price, 'item'=>$item, 'product_id'=>$item->id, 'seller'=>$item->user_id];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->product_price * $storedItem['qty'];
        $storedItem['product_id'] = $item->id;
        $storedItem['seller'] = $item->user_id;
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->product_price;
    }
}
