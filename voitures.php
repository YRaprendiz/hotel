<html>
<head>
    <meta charset="utf-8" />
    <title>Voitures</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
// Incluir o arquivo de conexão com o banco de dados
include("./connexion.php");
include("./header.php");

// Consulta SQL para recuperar os dados dos carros
$sql = "SELECT * FROM voiture";
$result = $connexion->query($sql);

if ($result) {
    // Exibir os dados dos carros se a consulta foi bem-sucedida
    echo "<div id='listChambres'>";
    foreach ($result as $row) {
        echo "<div class='chambres'>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' />";
        echo "<div><h2>" . $row['modele'] . "</h2>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Prix: " . $row['prix'] . " €</p>";
        echo "<p>Quantité disponible: " . $row['quantite'] . "</p></div>";
        echo "<div><a href='voiture.php?id=" . $row['id'] . "' class='button'>Voir détails</a></div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    // Exibir mensagem de erro se a consulta falhou
    echo "Pb d'accès au voitures";
}

// Incluir o rodapé
include("./footer.php");
?>
</body>
</html>
