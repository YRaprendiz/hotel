<h1>Liste des chambres</h1>
<ul>
    <?php foreach ($listeChambre as $chambre): ?>
        <li><a href="?page=chambre&id=<?php echo $chambre['id']; ?>"><?php echo $chambre['type']; ?></a></li>
    <?php endforeach; ?>
</ul>