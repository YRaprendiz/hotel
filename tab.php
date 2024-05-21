<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barr de recgerche city's</title>
</head>
<body>

<form id="city" method="POST" action="">
    <label for="city">
        Your city hotel
    </label>
    <input list="places" type="text" id="city" name="city" required autoComplete="off" pattern=".*">
    <datalist id="places">
        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hotel"; // Substitua pelo nome do seu banco de dados

        // Criar conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexão
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Consulta SQL para buscar `id` e `type`
        $sql = "SELECT id, type FROM chambres";
        $result = $conn->query($sql);

        // Preencher a datalist com os resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']} - {$row['type']}'></option>";
            }
        } else {
            echo "<option value='No results'></option>";
        }

        // Fechar conexão
        $conn->close();
        ?>
    </datalist>
    <button type="submit">Chercher</button>
</form>

<?php
// Lógica para lidar com o envio do formulário, se necessário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city = $_POST['city'];
    echo "<p>Você pesquisou por: $city</p>";
}
?>

</body>
</html>
