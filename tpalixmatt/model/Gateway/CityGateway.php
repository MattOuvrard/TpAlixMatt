<?php

namespace Model\Gateway;

use App\Src\App;

class CityGateway
{
    private $conn;

    private $id;

    private $nom;
    
    private $prenom;
    
    private $username;
    
    private $age;
    
    private $job;
    
    private $typeOfMagic;
    
    private $House;
    
    public function  __construct(App $app)
    {
        $this->conn = $app->getService('database')->getConnection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

     public function setNom($nom): void
    {
        $this->nom = $nom;
    }
    
    
    public function getPrenom()
    {
        return $this->prenom;
    }
    
       public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }
    
    
    public function getUserName()
    {
        return $this->username;
    }
    
       public function setUserName($username): void
    {
        $this->username = $username;
    }
    
    
    public function getAge()
    {
        return $this->age;
    }
    
       public function setAge($age): void
    {
        $this->age = $age;
    }
    
    
    public function getJob()
    {
        return $this->job;
    }
    
       public function setJob($job): void
    {
        $this->job = $job;
    }
    
    
    public function getTypeOfMagic()
    {
        return $this->typeOfMagic;
    }
    
       public function setTypeOfMagic($typeOfMagic): void
    {
        $this->typeOfMagic = $typeOfMagic;
    }
    
   
    public function getHouse()
    {
        return $this->House;
    }
    
       public function setTypeOfMagic($House): void
    {
        $this->House = $House;
    }
   
    
    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $life
     */
    public function setLife($life): void
    {
        $this->life = $life;
    }

    /**
     * @return mixed
     */
    public function getLife()
    {
        return $this->life;
    }

    public function insert() : void
    {
        $query = $this->conn->prepare('INSERT INTO city (nom, prenom, nom_utilisateur, age, profession, type_de_magie, maison) VALUES (:nom, :prenom, :nom_utilisateur, :age, :profession, :type_de_magie, :maison)');
        $executed = $query->execute
        ([
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':age' => $this->age,
            ':nom_utilisateur' => $this->username,
            ':profession' => $this->job,
            ':type_de_magie' => $this->TypeOfMagic,
            ':maison' => $this->House
         ]);

        if (!$executed) throw new \Error('Insert Failed');

        $this->id = $this->conn->lastInsertId();
    }

    public function update() : void
    {
        if (!$this->id) throw new \Error('Instances does not exist in base');

        $query = $this->conn->prepare('UPDATE profils SET nom=nom, prenom=:prenom, nom_utilisateur=:nom_utilisateur, age =:age, profession=:profession, type_de_magie = :type_de_magie, maison =:maison  WHERE id = :id');
        $executed = $query->execute
        ([
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':age' => $this->age,
            ':nom_utilisateur' => $this->username,
            ':profession' => $this->job,
            ':type_de_magie' => $this->TypeOfMagic,
            ':maison' => $this->House        
        ]);

        if (!$executed) throw new \Error('Update Failed');
    }

    public function hydrate(Array $element)
    {
        $this->id = $element['id'];
        $this->username = $element['nom_utilisateur'];
        $this->House = $element['maison'];
        $this->age = $element['age'];
    }
}
