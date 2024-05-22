<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />    <title>Hotel MYHW</title>    <link rel="stylesheet" href="style.css" />
</head>

<?php
// Incluir arquivos necessários
include("./header.php");
include("./connexion.php");
include("./tab.php");

echo "<h3>Notres Chambres</h3>";
// Requête SQL pour récupérer les données de la pièce
$sql = "SELECT * FROM `chambres`";
if(!$connexion->query($sql)){
    echo "<div id='listChambres'>";
      // Parcourez les résultats de la requête
    foreach ($connexion->query($sql) as $row) {
        echo "<div class='chambres'>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' />";
            echo "<div><h2>" . $row['type'] . "</h2>";
            echo "<p>chambre: ".$row['nb_max_chambre']." persones</p>";
            echo "<p>Prix par nuit: " . $row['prix_nuit'] . " €</p></div>";
                echo "<div><a href='chambres.php?id=" . $row['id'] . "' class='button'>Voir détails</a></div>";
            echo "</div>";
    }
    echo "</div>";
} else {
    echo "Pb d'accès au events";
}
include("./footer.php");
?>
</body>
</html>
