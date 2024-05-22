<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Réserver Voiture</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<?php
$dsn = "mysql:dbname=hotel;host=localhost";
try {
    $connexion = new PDO($dsn, "root", "");
} catch (PDOException $e) {
    printf("Échec de la connexion : %s\n", $e->getMessage());
    exit();
}
include("./header.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = ['voiture_id', 'checkin_date', 'checkout_date', 'prix'];
    $all_fields_filled = true;
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $all_fields_filled = false;
            break;
        }
    }

    if ($all_fields_filled) {
        $check_availability_stmt = $connexion->prepare("SELECT COUNT(*) FROM reservations_voiture 
            WHERE voiture_id = ? AND 
            ((checkin_date <= ? AND checkout_date > ?) OR 
            (checkin_date < ? AND checkout_date >= ?))");

        $check_availability_stmt->execute([
            $_POST['voiture_id'], 
            $_POST['checkout_date'], 
            $_POST['checkin_date'], 
            $_POST['checkout_date'], 
            $_POST['checkin_date']
        ]);
        $availability_count = $check_availability_stmt->fetchColumn();

        if ($availability_count == 0) {
            $stmt = $connexion->prepare("INSERT INTO reservations_voiture 
                (voiture_id, checkin_date, checkout_date, user, email_user, prix, nb) 
                VALUES (?, ?, ?, ?, ?, ?, ?)");

            $user_id = $_SESSION["user"]["id"];
            $user_email = $_SESSION["user"]["email"];
            $nb = (strtotime($_POST['checkout_date']) - strtotime($_POST['checkin_date'])) / (60 * 60 * 24);

            if ($stmt->execute([
                $_POST['voiture_id'], 
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
            echo "La voiture n'est pas disponible pour les dates sélectionnées.";
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}

echo "<h3>Réserver Voiture</h3>";

if (isset($_GET['id'])) {
    $voiture_id = $_GET['id'];
    $sql = "SELECT * FROM `voiture` WHERE id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$voiture_id]);
    $row = $stmt->fetch();
    
    if ($row) {
        $reservations_stmt = $connexion->prepare("SELECT checkin_date, checkout_date FROM reservations_voiture WHERE voiture_id = ?");
        $reservations_stmt->execute([$voiture_id]);
        $reservations = $reservations_stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='voiture'>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' />";
            echo "<p>" . $row['description'] . "</p>";
            echo "<div><h2>" . $row['modele'] . "</h2><p>Prix: <strong>" . $row['prix'] . "</strong> €</p></div>";
            echo "<div class='resv-form'>";
                echo "<form action='' method='POST'>";
                    echo "<input type='hidden' name='voiture_id' value='" . $row['id'] . "'>";
                    echo "<input type='hidden' name='prix' value='" . $row['prix'] . "'>";
                    echo "<label for='checkin_date'>Sélectionnez la date de départ : </label>";
                    echo "<input type='text' id='checkin_date' name='checkin_date' class='datepicker' required>";
                    echo "<label for='checkout_date'>Sélectionnez la date de retour:</label>";
                    echo "<input type='text' id='checkout_date' name='checkout_date' class='datepicker' required>";
                    echo "<button type='submit' class='button'>Réserver</button>";
                echo "</form>";
            echo "</div>";
        echo "</div>";

        echo "<h3>Disponibilité de la voiture</h3>";
        echo "<div id='availability-calendar'></div>";
    } else {
        echo "Aucune voiture trouvée avec l'ID spécifié.";
    }
} else {
    echo "ID de voiture non spécifié.";
}
?>
<?php
    
    echo "<div id='media_voiture'>";
    echo "<p>Photos</p>";
    $stmt2 = $connexion->prepare("SELECT * FROM media_voiture WHERE event = ?");
    $stmt2->execute([$_GET['id']]);
    $results = $stmt2->fetchAll();
    foreach ($results as $media) {
        echo "<img class='media' src='data:image/jpeg;base64," . base64_encode($media['image']) . "'/>";
    }
    echo "</div>";
    ?>

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

