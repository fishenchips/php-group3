<?php

class ProductOrder
{
    public $id;
    public $order_id;
    public $product_id;

    public function __construct($order_id, $product_id, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }

        $this->order_id = $order_id;
        $this->product_id = $product_id;
    }
}
// skapa klassen,
// ändra variablerna i  add_order_to_product_orders($order_id, $product_id)
// hitta hur man postar flera id samma sätt