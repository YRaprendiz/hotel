<?php
include_once('../modele/chambreModele.php');

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
}
?>
