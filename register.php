<?php
require_once ('headers.php');
require_once ('functions.php');

$data = json_decode(file_get_contents("php://input"));

$firstName = filter_var($data->firstName, FILTER_SANITIZE_STRING);
$lastName = filter_var($data->lastName, FILTER_SANITIZE_STRING);
$userName = filter_var($data->userName, FILTER_SANITIZE_STRING);
$password = filter_var($data->password, FILTER_SANITIZE_STRING);

try {
    $dbcon = openDb();
    $sql = "INSERT INTO user VALUES(?,?,?,?)";
    $prepared = $dbcon->prepare($sql);
    $prepared-> execute(array($firstName, $lastName, $userName, $password));

    

} catch(PDOException $e) {
    echo '<br>'.$e->getMessage();
}