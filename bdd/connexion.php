<?php
try{
    $user = "root";
    $pass = "";
    $connexion = new PDO('mysql:host=localhost;dbname=hotel_claude', $user, $pass);
    
}catch(PDOException $e){
    print "Erreur! Échec de la connexion:" . $e->getMessage() . "<br/>";
    error_log("Erreur de connexion à la base de données: " . $e->getMessage());
    die("Connexion impossible à la base de données.");
}
?>