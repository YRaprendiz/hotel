//detailschambres.php 
<?php include('/xampp/htdocs/GitYR/hotel/vues/communs/header.php'); ?>

<?php include('vues/communs/header.php'); ?>

<div class="container my-5">
    <?php if (!empty($chambre)): ?>
        <div class="card">
            <img src="public/images/<?= htmlspecialchars($chambre['image'] ?? 'default_room.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($chambre['chambres_type']) ?>">
            <div class="card-body">
                <h1 class="card-title"><?= htmlspecialchars($chambre['chambres_type']) ?></h1>
                <p class="card-text">Prix : <?= htmlspecialchars($chambre['prix']) ?> € / nuit</p>
                <p class="card-text">Description : <?= htmlspecialchars($chambre['description']) ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Chambre introuvable.</div>
    <?php endif; ?>
</div>

<?php include('vues/communs/footer.php'); ?>

<?php include('views/communs/footer.php'); ?>
