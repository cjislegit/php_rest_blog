<?php

class Database
{
//DB Params
    private $host = "localhost";
    private $db = "blog";
    private $username = "root";
    private $password = "123456";
    private $conn;

    //DB Connect
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host; dbname=$this->db", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo "Connection Error: $error->getMessage();";
        }

        return $this->conn;
    }
}