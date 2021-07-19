<?php
// Sets the headers that will be accepted
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Includes all the required files
include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Checks if the request has an id as a parameter
$id = isset($_GET['id']) ? $_GET['id'] : die();

// Create the database connection
$database = new Database();
$conn = $database->connect();

// Read data from posts table
$blogPost = new Post($conn);
$result = $blogPost->readSingle($id);
$noOfRows = $result->rowCount();
$post_arr = array();
if ($noOfRows > 0) {
  $post_arr['data'] = $result->fetch(PDO::FETCH_ASSOC);
  echo json_encode($post_arr);
} else {
  echo json_encode(array('message' => 'No records found for the given id'));
}
?>