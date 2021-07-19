<?php
  class Post {
    // Database handls
    private $conn;
    
    // Initialize conn
    public function __construct($conn) {
      $this->conn = $conn;
    }

    // Reads data from the database
    public function read() {
      $query = 'SELECT c.name as categoryName, c.id as categoryId, p.id, p.title,
        p.body, p.author, p.created_at
      FROM posts p
      LEFT JOIN categories c ON p.category_id = c.id
      ORDER BY  p.created_at DESC';
      
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }

    public function readSingle($id) {
      // Setting up the query
      $query = 'SELECT p.id, p.title, p.body, p.author, p.created_at, c.name as category_name
      FROM posts as p
      LEFT JOIN categories as c
      ON p.category_id = c.id
      WHERE p.id = ?';

      // Returns the result by preparing and executing the query
      $stmt = $this->conn->prepare($query);
      $stmt->execute([$id]);
      return $stmt;
    }

    public function create($data) {
      $category_id = $data['category_id'];
      $title = $data['title'];
      $body = $data['body'];
      $author = $data['author'];

      $query = 'INSERT INTO posts (category_id, title, body, author)
      VALUES (:category_id, :title, :body, :author)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':category_id', $data['category_id']);
      $stmt->bindParam(':title', $data['title']);
      $stmt->bindParam(':body', $data['body']);
      $stmt->bindParam(':author', $data['author']);

      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }
    }

    // Update posts
    public function update($data) {
      $data = json_decode($data);

      $query = 'UPDATE posts
      SET title = :title, body = :body
      WHERE id = :id';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam('id', $data->id);
      $stmt->bindParam('title', $data->title);
      $stmt->bindParam('body', $data->body);

      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function delete($data) {
      $data = json_decode($data);
      $query = 'DELETE FROM posts WHERE id = :id';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam('id', $data->id);

      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }
    }
  }