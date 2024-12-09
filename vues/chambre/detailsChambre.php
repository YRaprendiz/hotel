//detailschambres.php 
<?php include('/xampp/htdocs/GitYR/hotel/vues/communs/header.php'); ?>

<div class="container my-5">
    <?php if (!empty($chambre)): ?>
        <div class="card">
            <?php if (!empty($chambre['image'])): ?>
                <img src="public/images/<?= htmlspecialchars($chambre['image']) ?>" class="card-img-top" alt="Chambre">
            <?php else: ?>
                <img src="public/images/default_room.jpg" class="card-img-top" alt="Chambre par défaut">
            <?php endif; ?>
            <div class="card-body">
                <h1 class="card-title"><?= htmlspecialchars($chambre['chambres_type']) ?></h1>
                <p class="card-text"><strong>Prix :</strong> <?= htmlspecialchars($chambre['prix']) ?> € / nuit</p>
                <p class="card-text"><strong>Status :</strong> 
                    <?= htmlspecialchars($chambre['status'] === 'available' ? 'Disponible' : ($chambre['status'] === 'booked' ? 'Réservée' : 'En maintenance')) ?>
                </p>
                <p class="card-text"><strong>Description :</strong> <?= htmlspecialchars($chambre['description']) ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">La chambre demandée n'a pas été trouvée.</div>
    <?php endif; ?>
</div>

<?php include('views/communs/footer.php'); ?>
