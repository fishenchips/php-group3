<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "root";
    private $db = "group3_db";

    protected $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

        if (!$this->conn) {

            die("Error connection to db!");
        }
    }
}
