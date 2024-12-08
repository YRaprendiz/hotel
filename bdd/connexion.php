<?php
try{
    $user = "root";
    $pass = "";
    $connexion_hc = new PDO('mysql:host=localhost;dbname=hotel_chat', $utilisateur, $pass);
    
}catch(PDOException $e){
    print "Erreur! Échec de la connexion:" . $e->getMessage() . "<br/>";
    error_log("Erreur de connexion à la base de données: " . $e->getMessage());
    die("Connexion impossible à la base de données.");
}
return $connexion_hc;
?>