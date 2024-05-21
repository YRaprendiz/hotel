<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Reservas</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
include("./header.php");
include("./connexion.php");
// Verificar se o usuário está logado e recuperar seu tipo
if (isset($_SESSION['user'])) {
    $userType = $_SESSION['user']['type'];
    $userId = $_SESSION['user']['id'];

    if ($userType == 2) {
        // Administrador: mostrar todas as reservas (carros e quartos)
        echo '<h3>Réservations pour toutes les chambres et voitures</h3>';
        $stmt = $connexion->prepare("
            SELECT 'Chambre' as type, id, chambre_id as item_id, user, email_user, checkin_date, checkout_date, prix, nb, created_at
            FROM reservations_chambre
            UNION ALL
            SELECT 'Voiture' as type, id, voiture_id as item_id, user, email_user, checkin_date, checkout_date, prix, nb, created_at
            FROM reservations_voiture
        ");
    } else if ($userType == 1) {
        // Cliente: mostrar apenas suas reservas (carros e quartos)
        echo '<h3>Vos réservations de chambres et de voitures</h3>';
        $stmt = $connexion->prepare("
            SELECT 'Chambre' as type, id, chambre_id as item_id, user, email_user, checkin_date, checkout_date, prix, nb, created_at
            FROM reservations_chambre
            WHERE user = :userId
            UNION ALL
            SELECT 'Voiture' as type, id, voiture_id as item_id, user, email_user, checkin_date, checkout_date, prix, nb, created_at
            FROM reservations_voiture
            WHERE user = :userId
        ");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    } else {
        echo "Você não está autorizado a acessar esta página.";
        exit();
    }

    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($reservations) {
        echo '<table>
                <thead>
                    <tr>
                        <th>ID de Reserva</th>
                        <th>Tipo</th>
                        <th>ID do Item</th>
                        <th>Usuário</th>
                        <th>Email do Usuário</th>
                        <th>Data de Check-in</th>
                        <th>Data de Check-out</th>
                        <th>Preço</th>
                        <th>Número de Dias</th>
                        <th>Data de Criação</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($reservations as $reservation) {
            echo '<tr>
                    <td>' . htmlspecialchars($reservation['id']) . '</td>
                    <td>' . htmlspecialchars($reservation['type']) . '</td>
                    <td>' . htmlspecialchars($reservation['item_id']) . '</td>
                    <td>' . htmlspecialchars($reservation['user']) . '</td>
                    <td>' . htmlspecialchars($reservation['email_user']) . '</td>
                    <td>' . htmlspecialchars($reservation['checkin_date']) . '</td>
                    <td>' . htmlspecialchars($reservation['checkout_date']) . '</td>
                    <td>' . htmlspecialchars($reservation['prix']) . '</td>
                    <td>' . htmlspecialchars($reservation['nb']) . '</td>
                    <td>' . htmlspecialchars($reservation['created_at']) . '</td>
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo "Nenhuma reserva encontrada.";
    }
} else {
    echo "Você não está logado.";
}
?>

</body>
</html>
