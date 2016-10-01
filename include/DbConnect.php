<?php

class DbConnect{
    
    private $conn;

    function connect(){
        include_once dirname(__FILE__).'/config.php';
        $this->conn = new PDO("mysql:host=".DB_HOST.";charset=utf8".";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->conn;
    }
}

?>