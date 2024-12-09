<?php include('./vues/communs/header.php'); ?>
<?php
if ($adminController->addRoom($_POST)) {
    FlashMessage::set('success', 'Chambre ajoutée avec succès.');
    header('Location: index.php?page=adminDashboard');
} else {
    FlashMessage::set('danger', 'Échec de l’ajout de la chambre. Veuillez réessayer.');
    header('Location: index.php?page=addRoom');
}
exit;

?>
<div class="container">
    <h1>Ajouter une chambre</h1>
    <form action="index.php?page=addRoomAction" method="POST">
        <label>Numéro de chambre :</label>
        <input type="text" name="room_number" required>
        <label>Type :</label>
        <input type="text" name="room_type" required>
        <label>Prix :</label>
        <input type="number" step="0.01" name="price" required>
        <label>Status :</label>
        <select name="status">
            <option value="available">Disponible</option>
            <option value="booked">Réservée</option>
            <option value="maintenance">En maintenance</option>
        </select>
        <label>Description :</label>
        <textarea name="description"></textarea>
        <button type="submit">Ajouter</button>
    </form>
</div>
<?php include('./vues/communs/footer.php'); ?>
