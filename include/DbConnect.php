<?php

class DbConnect{
    
    private $conn;

    function connect(){
        include_once dirname(__FILE__).'/config.php';
        $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->conn;
    }
}

?>