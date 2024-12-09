<?php include('./vues/communs/header.php'); ?>

<div class="container my-5">
    <h1>Liste des Messages de Contact</h1>

    <?php if (empty($messages)): ?>
        <p>Aucun message pour l'instant.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?= htmlspecialchars($message['nom']) ?></td>
                        <td><?= htmlspecialchars($message['email']) ?></td>
                        <td><?= htmlspecialchars($message['message']) ?></td>
                        <td><?= htmlspecialchars($message['date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include('./vues/communs/footer.php'); ?>
