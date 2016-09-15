<?php

class DbHandler{
    private $conn;

    function __construct(){
        require_once dirname(__FILE__).'/DbConnect.php';
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    function createAddress($name, $parent_id){
        $sql = "INSERT INTO addresses (name, parent_id) VALUES(:name, :parent_id)";
        try{
            $stmt = $this->conn->prepare($sql);  
            $stmt->bindParam("name", $name);
            $stmt->bindParam("parent_id", $parent_id);
            $stmt->execute();
            $address_id = $this->conn->lastInsertId();
            return $Address_id;
        }catch(PDOException $e){
            return $e;
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        }
    }

    function getAddresses(){
        $sql = "SELECT * FROM addresses";
        try{
            $stmt = $this->conn->query($sql);  
            $addresses = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $addresses;
        }catch(PDOException $e){
            echo '{"error":{"text":'. $e->getMessage() .'}}';
            return $e;
        }
    }

    function deleteAddress($address_id){
        $sql = "DELETE FROM addresses WHERE id=:address_id";
        try{
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("address_id",$address_id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            return $e;
             echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
}


?>