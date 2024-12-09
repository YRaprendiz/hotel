<?php include('./vues/communs/header.php'); ?>
<div class="container">
    <h1>Modifier une chambre</h1>
    <form action="index.php?page=editRoomAction&id=<?= $room['id_chambre'] ?>" method="POST">
        <label>Numéro de chambre :</label>
        <input type="text" name="room_number" value="<?= htmlspecialchars($room['chambres_number']) ?>" required>
        <label>Type :</label>
        <input type="text" name="room_type" value="<?= htmlspecialchars($room['chambres_type']) ?>" required>
        <label>Prix :</label>
        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($room['prix']) ?>" required>
        <label>Status :</label>
        <select name="status">
            <option value="available" <?= $room['status'] == 'available' ? 'selected' : '' ?>>Disponible</option>
            <option value="booked" <?= $room['status'] == 'booked' ? 'selected' : '' ?>>Réservée</option>
            <option value="maintenance" <?= $room['status'] == 'maintenance' ? 'selected' : '' ?>>En maintenance</option>
        </select>
        <label>Description :</label>
        <textarea name="description"><?= htmlspecialchars($room['description']) ?></textarea>
        <button type="submit">Modifier</button>
    </form>
</div>
<?php include('./vues/communs/footer.php'); ?>
