<?php
try{
    $user = "root";
    $pass = "";
    $connexion = new PDO('mysql:host=localhost;dbname=hotel_claude', $user, $pass);
    
}catch(PDOException $e){
    print "Erreur! Échec de la connexion:" . $e->getMessage() .
    "<br/>";
    die();
}
?>