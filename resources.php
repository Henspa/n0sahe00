<?php
session_start();
require_once('headers.php');
require_once('functions.php');

if(!isset($_SESSION["user"])){
    exit;
}

$requestHeaders = apache_request_headers();

// Onko auth header olemassa
if(isset($requestHeaders["Authorization"])){

    // Halkaistaan osiin bearer ja token
    $auth_value = explode('', $requestHeaders["Authorization"]);
    

    if($auth_value[0] === 'Bearer'){
        $token = $auth_value[1];

        // Tarkastetaan onko token sama kuin sessioon tallennettu
        if($token === $_SESSION["token"]){
        echo "On kunnossa!";
        }
    }
    
}

