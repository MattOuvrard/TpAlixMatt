<?php

namespace Model;

#require_once("CitiesInterface.php");
use Model\CitiesInterface;
use Database\Database;

class ProfilsModel implements ProfilsInterface {

    private $conn;

    public function __construct(Database $database) {
        $this->conn = $database->getConnection();
    }

    public function findAll() : Array {
        $query = $this->conn->prepare('SELECT p.id, p.nom, c.prenom, c.nom_utilisateur, FROM profils p ORDER BY p.nom_utilisateur'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findAllMaison() : Array {
        $query = $this->conn->prepare('SELECT DISTINCT p.maison FROM profils p ORDER BY p.maison'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findAByMaison($maison) : Array {
        $query = $this->conn->prepare('SELECT p.id, p.nom_utilisateur, p.maison FROM profils p WHERE p.maison = :maison ORDER BY p.nom_utilisateur'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':maison' => $maison]); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search($searchString) {
        $query = $this->conn->prepare('SELECT p.nom_utilisateur, p.maison FROM profils p WHERE p.nom_utilisateur like :search ORDER BY p.nom'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':search' => '%' . $searchString .  '%']); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findOneById($id) {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c WHERE c.id = :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
	

    public function save(Array $city) : Bool {
        $query = $this->conn->prepare('INSERT INTO city (name, country, life) VALUES (:name, :country, :life)'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        return $query->execute([
            ':name' => $city['name'],
            ':country'=> $city['country'],
            ':life' => $city['life']
        ]);
    }
}

