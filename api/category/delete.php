<?php

//Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Post Object
$category = new Category($db);

//Get Raw Posted Data
$data = json_decode(file_get_contents("php://input"));

//Set ID to Delete
$category->id = $data->id;

//Create Post
if ($category->delete()) {
    echo json_encode(
        array("message" => "Post Deleted")
    );
} else {
    echo json_encode(
        array("message" => "Post Not Deleted")
    );
}