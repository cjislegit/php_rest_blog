<?php

//Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Category Object
$category = new Category($db);

//Category Read Query
$result = $category->read();

//Get Row Count
$num = $result->rowCount();

//Check if Any Categories
if ($num > 0) {
    //Category Array
    $category_arr = array();
    $category_arr["data"] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array(
            "id" => $id,
            "name" => $name,
        );

        //Push to "data"
        array_push($category_arr["data"], $category_item);
    }

    //Turn to JSON & Output
    echo json_encode($category_arr);
} else {
    //No Category
    echo json_encode(
        array("message" => "No Categories Found")
    );
}