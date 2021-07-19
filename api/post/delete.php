<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: DELETE');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Method, Content-Type,
Access-Control-Allow-Headers');

$data = file_get_contents("php://input");

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$conn = $database->connect();

$post = new Post($conn);
if ($post->delete($data)) {
    echo json_encode(array("Message" => "Post deleted succesffully"));
} else {
    echo json_encode(array("Error" => "Could not delete the post"));
}