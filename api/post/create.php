<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Access-Control-Allow-Headers,
Content-Type');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Establish connection to the database
$database = new Database();
$conn = $database->connect();

$post = new Post($conn);
if ($post->create($_POST)) {
    echo json_encode(array('Message' => 'Post created successfully'));
} else {
    echo json_encode(array('Error' => 'Post creation failed'));
}