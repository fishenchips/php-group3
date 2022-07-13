<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Order.php";
require_once __DIR__ . "/ProductOrder.php";

class OrdersDatabase extends Database
{
    public function add_order_to_orders(Order $order)
    {
        $query = "INSERT INTO orders (customerId, `status`, `date`) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("iss", $order->customer_id, $order->status, $order->date);

        $success = $stmt->execute();

        //want to return id of the order
        if ($success) {
            return $stmt->insert_id;
        }

        return $success;
    }

    public function get_all_orders()
    {
        $query = "SELECT * FROM orders";

        $result = mysqli_query($this->conn, $query);

        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $orders = [];

        foreach ($db_orders as $db_order) {
            $customer_id = $db_order["customerId"];
            $status = $db_order["status"];
            $date = $db_order["date"];
            $id = $db_order["id"];

            $orders[] = new Order($customer_id, $status, $date, $id);
        }

        return $orders;
    }

    public function get_order_by_id($id)
    {
        $query = "SELECT * FROM orders WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_order = mysqli_fetch_assoc($result);

        $order = null;

        if ($db_order) {
            $db_id = $db_order["id"];
            $db_customer_id = $db_order["customerId"];
            $db_status = $db_order["status"];
            $db_date = $db_order["date"];

            $order = new Order($db_customer_id, $db_status, $db_date, $db_id);
        }

        return $order;
    }

    public function get_orders_by_customer_id($customer_id)
    {
        $query = "SELECT * FROM orders WHERE customerId = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $customer_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $orders;
    }

    public function update_order($status, $id)
    {
        $query = "UPDATE orders SET `status` = ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("si", $status, $id);

        return $stmt->execute();
    }

    public function add_order_to_product_orders(ProductOrder $product_order)
    {
        $query = "INSERT INTO `product_orders` (orderId, productId) VALUES (?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("ii", $product_order->order_id, $product_order->product_id);

        return $stmt->execute();
    }

    public function get_products_by_order_id($order_id)
    {
        $query = "SELECT * FROM `product_orders` 
            JOIN orders ON orders.id = `product_orders`.orderId
            JOIN products ON products.id = `product_orders`.productId
            WHERE orderId = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $order_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $products;
    }
}
