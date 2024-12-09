<?php
include('./bdd/connexion.php');
include ('./controller/chambreController.php');
class Chambre
{
    private $bdd;
    private $conn;


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

    
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM chambres";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($room_number, $room_type, $price, $description) {
        $query = "INSERT INTO chambres (room_number, room_type, price, description) VALUES (:room_number, :room_type, :price, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':room_number', $room_number);
        $stmt->bindParam(':room_type', $room_type);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM chambres WHERE id_chambres = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $room_number, $room_type, $price, $description) {
        $query = "UPDATE chambres SET room_number = :room_number, room_type = :room_type, price = :price, description = :description WHERE id_chambres = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':room_number', $room_number);
        $stmt->bindParam(':room_type', $room_type);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }


    
}
?>
