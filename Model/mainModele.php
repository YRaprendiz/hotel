<?php
// Inclure le fichier de connexion pour utiliser la variable $connexion
include ("../bdd/connexion.php");

/**
 * Exécute une requête SQL préparée avec des paramètres et retourne le résultat.
 *
 * @param string $sql La requête SQL avec des placeholders (?)
 * @param array $params Les paramètres à lier à la requête
 * @return PDOStatement Le résultat de la requête
 */
function executeQuery($sql, $params = []) {
    global $connexion;
    try {
        $stmt = $connexion->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        return false;
    }
}

/**
 * Récupère tous les enregistrements d'une table donnée.
 *
 * @param string $table Le nom de la table
 * @return array Les résultats sous forme de tableau associatif
 */
function getAll($table) {
    $sql = "SELECT * FROM $table";
    $stmt = executeQuery($sql);
    return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
}

/**
 * Récupère un enregistrement unique par son identifiant dans une table.
 *
 * @param string $table Le nom de la table
 * @param int $id L'identifiant de l'enregistrement
 * @return array|false L'enregistrement sous forme de tableau associatif ou false en cas d'erreur
 */
function getById($table, $id) {
    $sql = "SELECT * FROM $table WHERE id = ?";
    $stmt = executeQuery($sql, [$id]);
    return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
}
?>
