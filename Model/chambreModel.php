<?php
class Chambre
{
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function getAllChambres()
    {
        $sql = "SELECT * FROM CHAMBRES";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChambreById($id)
    {
        $sql = "SELECT * FROM CHAMBRES WHERE id_chambre = :id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
