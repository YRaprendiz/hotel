<?php
include('./bdd/connexion.php');
include('./model/chambreModel.php');

class ChambreController
{
    private $chambre;

    public function __construct($bdd)
    {
        $this->chambre = new Chambre($bdd);
    }

    public function afficherToutesLesChambres()
    {
        return $this->chambre->getAllChambres();
    }

    public function afficherDetailsChambre($id)
    {
        return $this->chambre->getChambreById($id);
    }


    public function list() {
        $chambreModel = new Chambre();
        $chambres = $chambreModel->getAll();
        include 'views/chambres/list.php';
    }
    

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $chambreModel = new Chambre();
            $chambreModel->create(
                $_POST['room_number'],
                $_POST['room_type'],
                $_POST['price'],
                $_POST['description']
            );
            header("Location: index.php?action=list_chambres");
        } else {
            include 'views/chambres/add.php';
        }
    }

    public function edit($id) {
        $chambreModel = new Chambre();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $chambreModel->update(
                $id,
                $_POST['room_number'],
                $_POST['room_type'],
                $_POST['price'],
                $_POST['description']
            );
            header("Location: index.php?action=list_chambres");
        } else {
            $chambre = $chambreModel->getById($id);
            include 'views/chambres/edit.php';
        }
    }


}
?>
