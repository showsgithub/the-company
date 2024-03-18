<?php
  class Database{
    // Define properties
    private $server_name = "localhost"; //XAMPP or MAMP
    private $username = "root";         //username by default
    private $password = "root";         //Empty for XAMPP, "root" for MAMP
    private $db_name  = "the_company";  //the name of the database
    protected $conn;

    // Define the constructor
    public function __construct(){
      // mysqli() - a built-in class file in PHP
      $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);

      // check if there is no error in connecting to the database
         # connect_erro - Boolean value: true or false
      if($this->conn->connect_error){
        die("Unable to connect to the database." . $this->conn->connect_error);
      }

    }
  }