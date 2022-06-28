<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Message.php";

class Messages_Database extends Database {
    
    // get all messages with the right id
    public function get_messages_by_customer_id($id) {
        $query = "SELECT * FROM messages WHERE customerId = ?
        ORDER BY id DESC";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $db_messages;
    }
    
    // post a new message to the database
    public function post_message(Message $message) {
        $query = "INSERT INTO messages (customerId, user, `message`) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("iss", $message->customer_id, $message->user, $message->message);

        $success = $stmt->execute();

        return $success;
    }
}