<div class="container my-5">
    <h1 class="text-center">Contactez-nous</h1>
    <p class="text-center">Vous avez une question ou un commentaire ? Remplissez le formulaire ci-dessous et nous vous répondrons rapidement.</p>

    <?php
    // Afficher les messages de succès ou d'erreur
    if (isset($_GET['success']) && $_GET['success'] == '1') {
        echo "<div class='alert alert-success'>Votre message a été envoyé avec succès !</div>";
    } elseif (isset($_GET['error']) && $_GET['error'] == '1') {
        echo "<div class='alert alert-danger'>Une erreur est survenue. Veuillez réessayer.</div>";
    }
    ?>

    <form action="../controleur/contactController.php" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
            <div class="invalid-feedback">Veuillez entrer votre nom.</div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">Veuillez entrer une adresse e-mail valide.</div>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            <div class="invalid-feedback">Veuillez entrer votre message.</div>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<script>
    // Script pour activer la validation du formulaire
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>