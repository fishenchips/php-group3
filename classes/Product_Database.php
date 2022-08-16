<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Product.php";

class Product_Database extends Database {


    public function get_all_products() {
        $query = "SELECT * from products";

        $result = mysqli_query($this->conn, $query);

        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $products = [];

        foreach ($db_products as $db_product) {
            $db_id = $db_product["id"];
            $db_name = $db_product["name"];
            $db_description = $db_product["description"];
            $db_price = $db_product["price"];
            $db_img_url = $db_product["imgUrl"];

            $products[] = new Product($db_name, $db_description, $db_price, $db_img_url, $db_id);
        }
        return $products;

    }

    public function get_product($id) {
        $query = "SELECT * FROM products WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_product = mysqli_fetch_assoc($result);

        $product = null;
        
        if ($db_product) {

            $db_id = $db_product["id"];
            $db_name = $db_product["name"];
            $db_description = $db_product["description"];
            $db_price = $db_product["price"];
            $db_img_url = $db_product["imgUrl"];

            $product = new Product($db_name, $db_description, $db_price, $db_img_url, $db_id);
        }
        
        return $product;
    }

    public function update_product(Product $product, $id) {
        $query = "UPDATE products SET `name`= ?, `description`= ?, `price`= ?, `imgUrl`= ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("ssisi", $product->name, $product->description, $product->price, $product->product_img, $id);

        return $stmt->execute();
    }

    public function delete_product($id) {
        $query = "DELETE FROM products WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function save_product(Product $product) {
        
        $query = "INSERT INTO products (`name`, `description`, price, `imgUrl`) VALUES (?, ?, ?, ?)";
    
        $stmt = mysqli_prepare($this->conn, $query);
        
        $stmt->bind_param("ssis", $product->name, $product->description, $product->price, $product->product_img);
    
        $success = $stmt->execute();
    
        return $success;
    }
}