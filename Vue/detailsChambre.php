<h1><?php echo $chambre['type']; ?></h1>
<p><?php echo $chambre['description']; ?></p>
<p>Prix par nuit : <?php echo $chambre['prix_nuit']; ?> €</p>
<a href="?page=reservation&id=<?php echo $chambre['id']; ?>">Réserver</a>