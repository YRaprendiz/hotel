<!--AdminController.php -->
<?php
include_once('./bdd/connexion.php');
include_once('./models/AdminModel.php');

class AdminController {
    private $model;

    public function __construct() {
        $this->model = new AdminModel();
    }

    // Gestion des utilisateurs
    public function addUser($data) {
        if ($this->model->addUser($data['nom'], $data['prenom'], $data['email'], $data['password'], $data['role'])) {
            $_SESSION['message'] = ['type' => 'success', 'content' => 'Utilisateur ajouté avec succès.'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'content' => 'Erreur lors de l’ajout de l’utilisateur.'];
        }
        header('Location: index.php?page=adminDashboard');
        exit;
    }

    public function editUser($id, $data) {
        if ($this->model->updateUser($id, $data)) {
            $_SESSION['message'] = ['type' => 'success', 'content' => 'Utilisateur modifié avec succès.'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'content' => 'Erreur lors de la modification de l’utilisateur.'];
        }
        header('Location: index.php?page=adminDashboard');
        exit;
    }

    public function deleteUser($id) {
        if ($this->model->deleteUser($id)) {
            $_SESSION['message'] = ['type' => 'success', 'content' => 'Utilisateur supprimé avec succès.'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'content' => 'Erreur lors de la suppression de l’utilisateur.'];
        }
        header('Location: index.php?page=adminDashboard');
        exit;
    }

    // Gestion des chambres
    public function addRoom($data) {
        if ($this->model->addRoom($data['room_number'], $data['room_type'], $data['price'], $data['status'], $data['description'])) {
            $_SESSION['message'] = ['type' => 'success', 'content' => 'Chambre ajoutée avec succès.'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'content' => 'Erreur lors de l’ajout de la chambre.'];
        }
        header('Location: index.php?page=adminDashboard');
        exit;
    }

    public function editRoom($id, $data) {
        if ($this->model->updateRoom($id, $data)) {
            $_SESSION['message'] = ['type' => 'success', 'content' => 'Chambre modifiée avec succès.'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'content' => 'Erreur lors de la modification de la chambre.'];
        }
        header('Location: index.php?page=adminDashboard');
        exit;
    }

    public function deleteRoom($id) {
        if ($this->model->deleteRoom($id)) {
            $_SESSION['message'] = ['type' => 'success', 'content' => 'Chambre supprimée avec succès.'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'content' => 'Erreur lors de la suppression de la chambre.'];
        }
        header('Location: index.php?page=adminDashboard');
        exit;
    }
}
?>
