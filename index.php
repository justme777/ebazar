<?php

require_once '/include/DbHandler.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/addresses', function(){
    $response = array();
    $db = new DbHandler();

    $result = $db->getAddresses();
    
    $response["error"]=false;
    $response["addresses"] = array();

    foreach($result as $address){
        $tmp = array();
        $tmp["id"] = $address->id;
        $tmp["name"] = $address->name;
        array_push($response["addresses"],$tmp);
    }
    echoResponse(200, $response);
});

$app->post('/addresses', function(){
    verifyRequiredParams(array('address'));
    $response = array();
    $address = $app->request->post('address');
    $db = new DbHandler();
    $address_id = $db->createaddress($address);
    if ($address_id != NULL) {
        $response["error"] = false;
        $response["message"] = "address created successfully";
        $response["address_id"] = $address_id;
        echoResponse(201, $response);
    } else {
        $response["error"] = true;
        $response["message"] = "Failed to create address. Please try again";
        echoResponse(200, $response);
    } 
});

$app->delete('/addresses/:id', function($address_id) use($app){
    $db = new DbHandler();
    $response = array();
    $result = $db->deleteAddress($address_id);
    if ($result) {
        $response["error"] = false;
        $response["message"] = "Address deleted succesfully";
    } else {
        $response["error"] = true;
        $response["message"] = "Address failed to delete. Please try again!";
    }
    echoResponse(200, $response);
});


/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoResponse(400, $response);
        $app->stop();
    }
}

/**
 * Validating email address
 */
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echoResponse(400, $response);
        $app->stop();
    }
}

/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}

$app->run();



?>