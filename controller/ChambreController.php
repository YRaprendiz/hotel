<!-- ChambreController.php -->
<?php

include('./models/ChambreModel.php');

class ChambreController {
    private $model;

    public function __construct() {
        $this->model = new ChambreModel();
    }
    protected function setFlashMessage($type, $message) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    // Récupérer toutes les chambres
    public function list() {
        $chambres = $this->model->getAll();
        if ($chambres) {
            $this->setFlashMessage('success', 'Chambres récupérées avec succès.');
        } else {
            $this->setFlashMessage('info', 'Aucune chambre disponible.');
        }
        return $chambres;
    }
    // Récupérer les détails d'une chambre
    public function details($id) {
        $chambre = $this->model->getById($id);
        if ($chambre) {
            $this->setFlashMessage('success', 'Détails de la chambre récupérés.');
        } else {
            $this->setFlashMessage('error', 'Chambre non trouvée.');
        }
        return $chambre;
    }
}
?>