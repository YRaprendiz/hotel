<?php
include_once('./bdd/connexion.php');

class ContactModel extends BaseModel {
    public function saveMessage($nom, $email, $message) {
        $stmt = $this->bdd->prepare("
            INSERT INTO contacts (nom, email, message)
            VALUES (:nom, :email, :message)
        ");
        return $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'message' => $message,
        ]);
    }

    public function getMessages() {
        $stmt = $this->bdd->query("SELECT * FROM contacts ORDER BY date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
s