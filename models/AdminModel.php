<?php
include_once('./bdd/connexion.php');

class AdminModel extends BaseModel {
    // Gestion des utilisateurs
    public function addUser($nom, $prenom, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->bdd->prepare("
            INSERT INTO utilisateurs (nom, prenom, email, password, role_id)
            VALUES (:nom, :prenom, :email, :password, :role_id)
        ");
        return $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $hashedPassword,
            'role_id' => $role
        ]);
    }

    public function updateUser($id, $data) {
        $stmt = $this->bdd->prepare("
            UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, role_id = :role_id
            WHERE id_utilisateur = :id
        ");
        return $stmt->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'role_id' => $data['role'],
            'id' => $id
        ]);
    }

    public function deleteUser($id) {
        $stmt = $this->bdd->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Gestion des chambres
    public function addRoom($room_number, $room_type, $price, $status, $description) {
        $stmt = $this->bdd->prepare("
            INSERT INTO chambres (chambres_number, chambres_type, prix, status, description)
            VALUES (:chambres_number, :chambres_type, :prix, :status, :description)
        ");
        return $stmt->execute([
            'chambres_number' => $room_number,
            'chambres_type' => $room_type,
            'prix' => $price,
            'status' => $status,
            'description' => $description
        ]);
    }

    public function updateRoom($id, $data) {
        $stmt = $this->bdd->prepare("
            UPDATE chambres SET chambres_number = :chambres_number, chambres_type = :chambres_type, 
            prix = :prix, status = :status, description = :description WHERE id_chambre = :id
        ");
        return $stmt->execute([
            'chambres_number' => $data['room_number'],
            'chambres_type' => $data['room_type'],
            'prix' => $data['price'],
            'status' => $data['status'],
            'description' => $data['description'],
            'id' => $id
        ]);
    }

    public function deleteRoom($id) {
        $stmt = $this->bdd->prepare("DELETE FROM chambres WHERE id_chambre = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
