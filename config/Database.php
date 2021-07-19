<?php
  class Database {
    private $host = 'localhost';
    private $dbName = 'myblog_db';
    private $username = 'myblog_user';
    private $password = 'myblog_1234';
    private $conn;
    
    public function connect() {
      // Ensuring connection in empty
      $this->conn = null;

      //Database source name
      $DSN = 'mysql:host='.$this->host.';dbname='.$this->dbName;
      
      // connecting to the database
      try {
          $this->conn = new PDO($DSN, $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        echo 'Connection error:'.$e->getMessage();
      }

      return $this->conn;
    }
  }