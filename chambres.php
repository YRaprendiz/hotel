<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Chambres</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<?php
include("./header.php");
include("./connexion.php");
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = ['chambre_id', 'checkin_date', 'checkout_date', 'prix'];
    $all_fields_filled = true;
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $all_fields_filled = false;
            break;
        }
    }

    if ($all_fields_filled) {
        $check_availability_stmt = $connexion->prepare("SELECT COUNT(*) FROM reservations_chambre 
            WHERE chambre_id = ? AND 
            ((checkin_date <= ? AND checkout_date > ?) OR 
            (checkin_date < ? AND checkout_date >= ?))");

        $check_availability_stmt->execute([
            $_POST['chambre_id'], 
            $_POST['checkout_date'], 
            $_POST['checkin_date'], 
            $_POST['checkout_date'], 
            $_POST['checkin_date']
        ]);
        $availability_count = $check_availability_stmt->fetchColumn();

        if ($availability_count == 0) {
            $stmt = $connexion->prepare("INSERT INTO reservations_chambre 
                (chambre_id, checkin_date, checkout_date, user, email_user, prix, nb) 
                VALUES (?, ?, ?, ?, ?, ?, ?)");

            $user_id = $_SESSION["user"]["id"];
            $user_email = $_SESSION["user"]["email"];
            $nb = (strtotime($_POST['checkout_date']) - strtotime($_POST['checkin_date'])) / (60 * 60 * 24);

            if ($stmt->execute([
                $_POST['chambre_id'], 
                $_POST['checkin_date'], 
                $_POST['checkout_date'], 
                $user_id, 
                $user_email, 
                $_POST['prix'], 
                $nb
            ])) {
                echo "Réservation réussie!";
            } else {
                echo "Erreur lors de la réservation.";
            }
        } else {
            echo "La chambre n'est pas disponible pour les dates sélectionnées.";
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}


if (isset($_GET['id'])) {
    $chambre_id = $_GET['id'];
    $sql = "SELECT * FROM `chambres` WHERE id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$chambre_id]);
    $row = $stmt->fetch();
    
    if ($row) {
        $reservations_stmt = $connexion->prepare("SELECT checkin_date, checkout_date FROM reservations_chambre WHERE chambre_id = ?");
        $reservations_stmt->execute([$chambre_id]);
        $reservations = $reservations_stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='chambres_dtls'>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' />";
            echo "<span>" . $row['description'] . "</span>";
            echo "<div><h2>" . $row['type'] . "</h2><p>Prix par nuit: <strong>" . $row['prix_nuit'] . "</strong> €</p></div>";
            echo "<div class='reservation-form'>";
                echo "<form action='' method='POST'>";
                    echo "<input type='hidden' name='chambre_id' value='" . $row['id'] . "'>";
                    echo "<input type='hidden' name='prix' value='" . $row['prix_nuit'] . "'>";
                    echo "<label for='checkin_date'>Sélectionnez la date de check-in : </label>";
                    echo "<input type='text' id='checkin_date' name='checkin_date' class='datepicker' required>";
                    echo "<label for='checkout_date'>Sélectionnez la date de check-out:</label>";
                    echo "<input type='text' id='checkout_date' name='checkout_date' class='datepicker' required>";
                    echo "<button type='submit' class='button'>Réserver</button>";
                echo "</form>";
            echo "</div>";
        echo "</div>";

        
        echo "<div id='availability-calendar'></div>";
    } else {
        echo "Aucune chambre trouvée avec l'ID spécifié.";
    }
} else {
    echo "ID de chambre non spécifié.";
}
?>
<div class="form-res">
        
        <?php
        if (isset($chambre_id)) {
            $reservations_query = "SELECT r.id, r.user, r.email_user, r.checkin_date, r.checkout_date, u.prenom, u.nom
                                   FROM reservations_chambre r
                                   JOIN user u ON r.user = u.id
                                   WHERE r.chambre_id = ?";
            $reservations_stmt = $connexion->prepare($reservations_query);
            $reservations_stmt->execute([$chambre_id]);
            $reservations = $reservations_stmt->fetchAll(PDO::FETCH_ASSOC);

            echo '<table>';
            echo '<tr><th>ID</th><th>Utilisateur</th><th>Email</th><th>Check-in</th><th>Check-out</th><th>Action</th></tr>';

            foreach ($reservations as $reservation) {
                $reservado_por_usuario = isset($_SESSION['user']['id']) && $reservation['user'] == $_SESSION['user']['id'];
                echo '<tr>';
                echo '<td>' . htmlspecialchars($reservation['id']) . '</td>';
                echo '<td>' . htmlspecialchars($reservation['prenom'] . ' ' . $reservation['nom']) . '</td>';
                echo '<td>' . htmlspecialchars($reservation['email_user']) . '</td>';
                echo '<td>' . htmlspecialchars($reservation['checkin_date']) . '</td>';
                echo '<td>' . htmlspecialchars($reservation['checkout_date']) . '</td>';
                echo '<td>';
                if ($reservado_por_usuario) {
                    echo '<form action="cancelar_reserva.php" method="POST" style="display:inline;">';
                    echo '<input type="hidden" name="reserva_id" value="' . htmlspecialchars($reservation['id']) . '">';
                    echo '<button type="submit">Annuler</button>';
                    echo '</form>';
                } else {
                    echo 'N/A';
                }
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        ?>
    </div>
<div class='title_media'>
    <?php
    echo "<h3>Disponibilité de la chambre</h3>";
    echo "<p>Photos</p>";
    echo "<div id='media_chambre'>";
    $stmt2 = $connexion->prepare("SELECT * FROM media_chambre WHERE event = ?");
    $stmt2->execute([$_GET['id']]);
    $results = $stmt2->fetchAll();
    foreach ($results as $media) {
        echo "<img class='media' src='data:image/jpeg;base64," . base64_encode($media['image']) . "'/>";
    }
    echo "</div>";
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const reservations = <?php echo json_encode($reservations); ?>;
        const unavailableDates = [];

        reservations.forEach(reservation => {
            let checkin = new Date(reservation.checkin_date);
            let checkout = new Date(reservation.checkout_date);

            while (checkin < checkout) {
                unavailableDates.push(checkin.toISOString().split('T')[0]);
                checkin.setDate(checkin.getDate() + 1);
            }
        });

        flatpickr(".datepicker", {
            minDate: "today",
            dateFormat: "Y-m-d",
            "locale": "fr",
            disable: unavailableDates,
            enable: [
                function(date) {
                    // Activer toutes les dates non présentes dans unavailableDates
                    return !unavailableDates.includes(date.toISOString().split('T')[0]);
                }
            ]
        });

        flatpickr("#checkin_date", {
            minDate: "today",
            dateFormat: "Y-m-d",
            "locale": "fr",
            disable: unavailableDates,
            enable: [
                function(date) {
                    // Activer toutes les dates non présentes dans unavailableDates
                    return !unavailableDates.includes(date.toISOString().split('T')[0]);
                }
            ],
            onChange: function(selectedDates, dateStr, instance) {
                const checkoutPicker = document.getElementById('checkout_date')._flatpickr;
                checkoutPicker.set('minDate', dateStr);
            }
        });

        flatpickr("#checkout_date", {
            minDate: "today",
            dateFormat: "Y-m-d",
            "locale": "fr",
            disable: unavailableDates,
            enable: [
                function(date) {
                    // Activer toutes les dates non présentes dans unavailableDates
                    return !unavailableDates.includes(date.toISOString().split('T')[0]);
                }
            ]
        });
    });
</script>


<?php
include("./footer.php");
?>
</body>
</html>