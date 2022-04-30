<?php

//Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Category Object
$category = new Category($db);

//Get Raw Category Data
$data = json_decode(file_get_contents("php://input"));

//Set ID to Update
$category->id = $data->id;

$category->name = $data->name;

//Create Post
if ($category->update()) {
    echo json_encode(
        array("message" => "Post Updated")
    );
} else {
    echo json_encode(
        array("message" => "Post Not Updated")
    );
}