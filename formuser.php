<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Utilisateurs enregistrés</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
include("./header.php");
include("./connexion.php");

// Verificar se o usuário está logado e o tipo de usuário
if (isset($_SESSION['user']['type'])) {
    $user_type = $_SESSION['user']['type'];

    if ($user_type == 2) {
        $users_stmt = $connexion->query("SELECT * FROM user");
        $users = $users_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Tabela de Usuários -->
<h3>Utilisateurs enregistrés</h3>
<div class='all_user'>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Type</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['id']); ?></td>
            <td><?php echo htmlspecialchars($user['prenom']); ?></td>
            <td><?php echo htmlspecialchars($user['nom']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo htmlspecialchars($user['type']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    } elseif ($user_type == 1) {
        // Usuário do tipo 1, não exibe nada
        echo "Accès non autorisé.";
    }
} else {
    echo "Accès non autorisé.";
}
?>

</body>
</html>
