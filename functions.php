<?php

//http://ebazar/cities/getCities
function getCities() {
    /*
	$sql = "SELECT * FROM cities;";
	try {
		$db = getDB();
		$stmt = $db->query($sql);  
		$cities = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"cities": ' . json_encode($cities) . '}';
	} catch(PDOException $e) {
	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}*/
    echo "asdasda";
}

function getAddress(){
    $sql = "SELECT * FROM cities WHERE id=:id";
    try{
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id");
    }catch(PDOException $e){
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

//http://ebazar/cities/insertAddress
function insertAddress(){
    $request = \Slim\Slim::getInstance()->request();
	$address = json_decode($request->getBody());
    $sql = "INSERT INTO cities (name, parent_id) VALEUS(:name, :parent_id)";
    try{
        $db = getDB();
		$stmt = $db->prepare($sql);  
        $stmt->bindParam("name", $address->name);
		$stmt->bindParam("parent_id", $address->parent_id);
        $stmt->execute();
        $address->id = $db->lastInsertId();
        $db = null;
		//$Address_id= $Address->id;
		//getUserUpdate($Address_id);
    }catch(PDOException $e){
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

?>