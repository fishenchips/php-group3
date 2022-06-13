<?php

// Class for product
class Product {

    public $id;
    public $name;
    public $description;
    public $price;
    public $product_img;


    public function __construct($name, $description, $price, $product_img, $id = 0)
    {
        if($id > 0) {
            $this->id = $id;
        }
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->product_img = $product_img;
    }

    public function __toString() {
        return "{$this->name} {$this->description} {$this->price}";
    }
}