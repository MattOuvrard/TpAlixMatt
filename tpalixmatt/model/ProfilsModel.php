<?php
namespace Model;
use Database\Database;
use Model\CitiesInterface;

class ProfilsModel implements CitiesInterface {

    private $conn;

    public function __construct(Database $database) {
        $this->conn = $database->getConnection();
    }

    public function findAll() : Array {
        $query = $this->conn->prepare('SELECT p.id, p.nom, p.prenom, p.nom_utilisateur, p.maison FROM profils p ORDER BY p.nom_utilisateur'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findAllMaison() : Array {
        $query = $this->conn->prepare('SELECT DISTINCT p.maison FROM profils p ORDER BY p.maison'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findAByCountry($name) : Array {
        $query = $this->conn->prepare('SELECT p.id, p.nom_utilisateur, p.type_de_magie, p.maison FROM profils p WHERE p.maison = :name ORDER BY p.nom_utilisateur'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':name' => $name]); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search($searchString) {
        $query = $this->conn->prepare('SELECT p.id, p.nom_utilisateur, p.maison, p.type_de_magie FROM profils p WHERE p.nom_utilisateur like :search ORDER BY p.nom_utilisateur'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':search' => '%' . $searchString .  '%']); // Exécution de la requête
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findOneById($id) {
        $query = $this->conn->prepare('SELECT p.nom_utilisateur, p.type_de_magie, p.maison FROM profils p WHERE p.id = :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function findOne(int $id)
    {
        $query = $this->conn->prepare('SELECT p.id, p.nom_utilisateur, p.type_de_magie, p.maison FROM profils p WHERE p.id = :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function save(Array $profils) : Bool {
        $query = $this->conn->prepare('INSERT INTO profils (nom, prenom, nom_utlisateur, age, profession, maison, type_de_magie) VALUES (:nom, :prenom, :nom_utilisateur, :age, :profession, :maison, :type_de_magie)'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        return $query->execute([
            ':nom' => $profils['nom'],
            ':prenom'=> $profils['prenom'],
            ':nom_utilisateur' => $profils['nom_utilisateur'],
            ':age' => $profils['age'],
            ':profession' => $profils['profession'],
            ':maison' => $profils['maison'],
            ':type_de_magie' => $profils['type_de_magie']
        ]);
    }
}

