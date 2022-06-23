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
}
