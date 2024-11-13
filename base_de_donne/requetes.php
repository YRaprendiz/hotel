<?php
include ("./connexion.php");

function getChambreById($id) {
    global $connexion;
    $stmt = $connexion->prepare("SELECT * FROM chambres WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getListeChambre() {
    global $connexion;
    $stmt = $connexion->query("SELECT * FROM chambres");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
