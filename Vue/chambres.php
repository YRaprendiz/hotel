<?php
    include("./bdd/connexion.php"); 
    include("./vue/header.php"); 
    ?>

    <div class="container mt-5">
        <h3 class="text-center">Nos Chambres</h3>
        <hr class="mb-5">

        <?php
        $sql = "SELECT * FROM `chambres`";
        if (!$connexion->query($sql)) {
            echo "<p class='text-danger'>Problème d'accès aux chambres.</p>";
        } else {
            echo "<div class='row'>";
            foreach ($connexion->query($sql) as $row) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card'>";
                
                if (!empty($row['image'])) {
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' class='card-img-top' alt='Image Chambre'>";
                } else {
                    echo "<img src='default.jpg' class='card-img-top' alt='Image par défaut'>";
                }

                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" .                htmlspecialchars($row['type']) . "</h5>";
                echo "<p class='card-text'>Chambre pour " .     htmlspecialchars($row['nb_max_chambre']) . " personnes</p>";
                echo "<p class='card-text'>Prix par nuit: " .   htmlspecialchars($row['prix_nuit']) . " €</p>";
                echo "<p class='card-text'>Services: Toilettes, Lit, Localisation, Parking, Wi-Fi, Déjeuner, Check-in et Check-out horaires</p>";
                echo "<a href='detailsChambre.php?id=" . $row['id'] . "' class='btn btn-primary'>Voir détails</a>";
                echo "</div></div></div>";
            }
            echo "</div>";
        }
        ?>
