<?php
header('Allow-Access-Control-Origin: *');
header('Allow-Access-Control-Method: PUT');
header('Content-Type: application/json');
header('Allow-Access-Control-Headers: Allow-Access-Control-Method, Content-Type,
Allow-Access-Control-Headers');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$data = file_get_contents("php://input");

$database = new Database();
$conn = $database->connect();

$post = new Post($conn);
if ($post->update($data)) {
    echo json_encode(array("Message" => "Updated"));
} else {
    echo json_encode(array("message" => "updation failed"));
}