<?php
session_start();
require_once('headers.php');
require_once('functions.php');

if( isset($_SERVER['PHP_AUTH_USER']) ){
    if(checkUser(openDb(), $_SERVER['PHP_AUTH_USER'],$_SERVER["PHP_AUTH_PW"] )){
        $_SESSION["user"] = $_SERVER['PHP_AUTH_USER'];
        $_SESSION["token"] =bin2hex(openssl_random_pseudo_bytes(16));

        echo json_encode( array ("info" => "Kirjauduit sisään", "token" => $_SESSION['token'] ));
        header('Content-Type: application/json');
        exit;
    }
}

echo '{"info":"Failed to login"}';
header('Content-Type: application/json');
header('HTTP/1.1 401');
exit;