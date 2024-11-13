<?php
$dsn = "mysql:dbname=hotel;host=localhost";
try {
    $connexion = new PDO($dsn, "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Échec de la connexion : " . $e->getMessage();
    exit();
}
?>
