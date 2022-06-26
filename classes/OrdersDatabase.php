<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Order.php";

class OrdersDatabase extends Database
{
    public function add_order_to_orders(Order $order)
    {
        $query = "INSERT INTO orders (customerId, `status`, `date`) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("iss", $order->customer_id, $order->status, $order->date);

        return $stmt->execute();
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

    public function add_order_to_product_orders($order_id, $product_id)
    {
        $query = "INSERT INTO `product_orders` (orderId, productId) VALUES (?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("ii", $order_id, $product_id);

        return $stmt->execute();
    }
}
