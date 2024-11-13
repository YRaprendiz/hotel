<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Hotel MYHW</title>
    <link rel="stylesheet" href="style.css" />
</head>

<?php
// Incluir arquivos necessários
include("../model/header.php");  // Assurez-vous que le header est inclus
include ("../base_de_donne/connexion.php"); // Connexion à la base de données
?>

<h3>Nos Chambres</h3>

<?php
// Requête SQL pour récupérer les données des chambres
$sql = "SELECT * FROM `chambres`";

if (!$connexion->query($sql)) {
    echo "Problème d'accès aux chambres.";
} else {
    echo "<div id='listChambres'>";
    // Parcourir les résultats de la requête
    foreach ($connexion->query($sql) as $row) {
        echo "<div class='chambres'>";
        
        // Affichage de l'image de la chambre
        echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Image Chambre' />";
        
        // Affichage des informations de la chambre
        echo "<div><h2>" . $row['type'] . "</h2>";
        echo "<p>Chambre pour " . $row['nb_max_chambre'] . " personnes</p>";
        echo "<p>Prix par nuit: " . $row['prix_nuit'] . " €</p>";
        echo "<p>Services: Toilettes, Lit, Localisation, Parking, Wi-Fi, Déjeuner, Check-in et Check-out horaires</p>";
        
        // Lien pour voir les détails de la chambre
        echo "<div><a href='chambres.php?id=" . $row['id'] . "' class='button'>Voir détails</a></div>";
        
        echo "</div>";  // Fermeture div 'chambres'
    }
    echo "</div>";  // Fermeture div 'listChambres'
}

// Inclure le footer
include("./footer.php");
?>

</body>
</html>