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
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Categories
    public function read()
    {
        //Create Query
        $query = "SELECT
            id,
            name,
            created_at
        FROM
            $this->table
        ORDER BY
            created_at DESC";

        //Prepate Statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;
    }

    //Get Single Category
    public function read_single()
    {
        //Create Query
        $query = "SELECT
            id,
            name,
            created_at
        FROM
            $this->table
        WHERE
            id = :id";

        //Prepare Statment
        $stmt = $this->conn->prepare($query);

        //Bind Data
        $stmt->bindParam(":id", $this->id);

        //Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set Properties
        $this->name = $row["name"];
    }

//Create Category
    public function create()
    {
        //Create Query
        $query = "INSERT INTO
            $this->table
            SET
                name = :name";

        //Prepare Statment
        $stmt = $this->conn->prepare($query);

        //Clean Data
        $this->name = htmlspecialchars($this->name);

        //Bind Data
        $stmt->bindParam(":name", $this->name);

        //Execute Query
        if ($stmt->execute()) {
            return true;
        } else {
            //Print Error
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

    }
}