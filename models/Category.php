<?php

class Category
{
    //DB Stuff
    private $conn;
    private $table = "categories";

    //Properties
    public $id;
    public $name;
    public $created_at;

    //Constructor with DB
    public function _construct($db)
    {
        $this->conn = $db;
    }
}