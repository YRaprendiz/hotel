<?php
include("./header.php");
include("./connexion.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['user']['id'])) {
    header('Location: login.php');
    exit();
}

// Obtém o ID da reserva
$reserva_id = isset($_POST['reserva_id']) ? intval($_POST['reserva_id']) : 0;
$usuario_id = $_SESSION['user']['id'];

// Consulta para verificar se a reserva pertence ao usuário logado
$query = "SELECT * FROM reservations_chambre WHERE id = ? AND user = ?";
$stmt = $connexion->prepare($query);
$stmt->execute([$reserva_id, $usuario_id]);
$result = $stmt->fetch();

if ($result) {
    // Se a reserva pertence ao usuário logado, cancela a reserva
    $delete_query = "DELETE FROM reservations_chambre WHERE id = ?";
    $delete_stmt = $connexion->prepare($delete_query);
    if ($delete_stmt->execute([$reserva_id])) {
        echo "Réservation annulée avec succès.";
    } else {
        echo "Erreur lors de l'annulation de la réservation.";
    }
} else {
    echo "Réservation non trouvée ou vous n'avez pas la permission de l'annuler.";
}

header('Location: '.$_SERVER['HTTP_REFERER']);
exit();
?>
