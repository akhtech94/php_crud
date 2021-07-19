<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include required files
include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Create the database connection
$dataBaseHandle = new Database();
$conn = $dataBaseHandle->connect();

// Read data from posts table
$blogPosts = new Post($conn);
$result = $blogPosts->read();
$noOfRows = $result->rowCount();
if ($noOfRows > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post = array(
            'id' => $id,
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'category_id' => $categoryId,
            'category_name' => $categoryName
        );

        array_push($posts_arr['data'], $post);
    }
    echo json_encode($posts_arr);
} else {
  echo json_encode(array('message' => 'No posts found'));
}

?>