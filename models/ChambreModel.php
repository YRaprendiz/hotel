<?php
include_once('./bdd/connexion.php');
class ChambreModel extends BaseModel  {
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function getAll() {
        $stmt = $this->bdd->query("SELECT * FROM chambres");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->bdd->prepare("SELECT * FROM chambres WHERE id_chambre = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
?>
