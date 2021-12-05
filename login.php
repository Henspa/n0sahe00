<?php
session_start();
require_once('headers.php');
require_once('functions.php');

if( isset($_SERVER['PHP_AUTH_USER']) ){
    if(checkUser(openDb(), $_SERVER['PHP_AUTH_USER'],$_SERVER["PHP_AUTH_PW"] )){
        $_SESSION["user"] = $_SERVER['PHP_AUTH_USER'];

        echo '{"info":"Kirjauduit sisään"}';
        header('Content-Type: application/json');
        exit;
    }
}

echo '{"info":"Failed to login"}';
header('Content-Type: application/json');
header('HTTP/1.1 401');
exit;