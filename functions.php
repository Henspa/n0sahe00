<?php
/**
 * Tarkistaa onko käyttäjä tietokannassa ja onko salasana validi
 */
function checkUser(PDO $dbcon, $userName, $password){


    $userName = filter_var($userName, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    try{
        $sql = "SELECT password FROM user WHERE userName=?";  
        $prepare = $dbcon->prepare($sql);   
        $prepare->execute(array($userName));  

        $rows = $prepare->fetchAll(); 

        
        foreach($rows as $row){
            $pw = $row["password"];  
            if( password_verify($password, $pw) ){  
                return true;
            }
        }

        
        return false;

    }catch(PDOException $e){
        echo print 401;
    }
}

/**
 * Luo tietokantaan uuden käyttäjän ja hashaa salasanan
 */
function createUser(PDO $dbcon, $firstName, $lastName, $userName, $password){

   
    $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
    $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
    $userName = filter_var($userName, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    try{
        $hash_pw = password_hash($password, PASSWORD_DEFAULT); 
        $sql = "INSERT IGNORE INTO user VALUES (?,?,?,?)"; 
        $prepare = $dbcon->prepare($sql); 
        $prepare->execute(array($firstName, $lastName, $userName, $hash_pw));  
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}

/**
 * Luo ja palauttaa tietokantayhteyden.
 */
function openDb(){

    try{
        $dbcon = new PDO('mysql:host=localhost;dbname=n0sahe00', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        echo '<br>'.$e->getMessage();
    }
    return $dbcon;
}
?>