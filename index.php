<?php
  class test {
    private $name;

    public function __construct($name) {
      $this->name = $name;
    }

    public function greet() {
      echo "Hello $this->name";
    }
  }

  $obj = new test("Akhil");
  $obj->greet();
  
  ?>
