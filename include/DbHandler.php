<?php
class DbHandler{

    private $conn;

    function __construct(){
        require_once dirname(__FILE__).'/DbConnect.php';
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
/*----------------------USERS------------------------------------------*/
    function createUser($email, $password){
        $user = $this->getUserByEmail($email);
        if($user!=null) {
            return USER_ALREADY_EXISTED;
        }else{
            require_once "PassHash.php";
            $sql="INSERT INTO users(email,password_hash,create_date) VALUES(:email,:password_hash,NOW())";
            try{
                $stmt=$this->conn->prepare($sql);
                $stmt->bindParam("email",$email);
                $password_hash = PassHash::hash($password);
                $stmt->bindParam("password_hash",$password_hash);
                $stmt->execute();
                //$stmt=null;
                return USER_CREATED_SUCCESSFULLY;
            }catch(PDOException $ex){
                return $ex;
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        }
        
    }

    function getUserByEmail($email){
        $sql = "SELECT * FROM users WHERE email=:email";
        try{
            $stmt=$this->conn->prepare($sql);
            $stmt->bindParam("email",$email);
            $stmt->execute();
            $user = $stmt->fetchObject();
            //$stmt=null;
            return $user;
        }catch(PDOException $ex){
            return "error";
            return $ex;
        }
    }

    function getUserByEmailPassword($email,$password){
        require_once "PassHash.php";
        $user = $this->getUserByEmail($email);
        if($user!=null){
            $password_hash = $user->password_hash;
            echo $password;
            if(PassHash::check_password($password_hash, $password)){
                return $user;
            }else{
                return "Invalid password";
            }
        }
    }

/*----------------------ADDRESSES------------------------------------------*/
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

/*----------------------MARKETS------------------------------------------*/

function createMarket($market){
    $sql="INSERT INTO markets(name,address_id,create_date,user_id,type_id) ".
    "VALUES(:name,:address_id,NOW(),:user_id,:type_id)";
    try{
        var_dump($market);
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam("name",$market->name);
        $stmt->bindParam("address_id",$market->address_id);
        $stmt->bindParam("user_id",$market->user_id);
        $stmt->bindParam("type_id",$market->type_id);
        $stmt->execute();
        return true;
    }catch(PDOException $ex){
        return $ex;
    }
}

function getMarketTypes(){
    $sql = "SELECT * FROM classifier_values WHERE classifier_id=1";
    try{
        $stmt = $this->conn->query($sql);  
        $addresses = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $addresses;
    }catch(PDOException $e){
        echo '{"error":{"text":'. $e->getMessage() .'}}';
        return $e;
    }    
}
/*----------------------Classifier------------------------------------------*/
function createClassifier($name){
    $sql = "INSERT INTO classifiers(name) VALUES(:name)";
    try{
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("name",$name);
        $stmt->execute();
        return true;
    }catch(PDOException $ex){
        return $ex;
    }         
}

function createClassifierValue($name,$classifier_id){
    $sql = "INSERT INTO classifier_values(name,classifier_id) VALUES(:name,:classifier_id)";
    try{
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("name",$name);
        $stmt->bindParam("classifier_id",$classifier_id);
        $stmt->execute();
        return true;
    }catch(PDOException $ex){
        return $ex;
    }         
}
/*----------------------ADDRESSES------------------------------------------*/
/*----------------------ADDRESSES------------------------------------------*/
/*----------------------ADDRESSES------------------------------------------*/
/*----------------------ADDRESSES------------------------------------------*/
/*----------------------ADDRESSES------------------------------------------*/
}
?>