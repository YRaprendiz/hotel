<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barr de recgerche city's</title>
</head>
<body>

<form id="city-form" method="POST" action="">
        <label for="city-input">
            Your city hotel
        </label>
        <input list="places" type="text" id="city-input" name="city" required autoComplete="off" pattern=".*">
        <datalist id="places">
            <?php
            $dsn = "mysql:dbname=hotel;host=localhost";
            try {
                $connexion = new PDO($dsn, "root", "");
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Correct SQL query to select id and type
                $sql = "SELECT id, type FROM chambres";
                $stmt = $connexion->query($sql);

                // Fetch results and populate datalist
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']} - {$row['type']}'></option>";
                }

                // Close connection
                $connexion = null;
            } catch (PDOException $e) {
                echo "<option value='Échec de la connexion : {$e->getMessage()}'></option>";
            }
            ?>
        </datalist>
        <button type="submit">Chercher</button>
    </form>

<?php
// Lógica para lidar com o envio do formulário, se necessário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city = $_POST['city'];
    echo "<p>Vous avez recherché : $city</p>";
}
?>

</body>
</html>
