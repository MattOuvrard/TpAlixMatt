<?php

namespace Model\Gateway;

use App\Src\App;

class ProfilsGateway
{
    private $conn;

    private $id;

    private $username;

    private $password;

    private $house;

    private $description;

    public function  __construct(App $app)
    {
        $this->conn = $app->getService('database')->getConnection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPassword(){
      return $this->password;
    }

    public function getUserName()
    {
        return $this->username;
    }

       public function setUserName($username)
    {
        $this->username = $username;
    }

    public function getHouse()
    {
        return $this->house;
    }

       public function setHouse($house)
    {
        $this->house = $house;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }



    // public function insert() : void
    // {
    //     $query = $this->conn->prepare('INSERT INTO city (nom, prenom, nom_utilisateur, age, profession, type_de_magie, maison) VALUES (:nom, :prenom, :nom_utilisateur, :age, :profession, :type_de_magie, :maison)');
    //     $executed = $query->execute
    //     ([
    //         ':nom' => $this->nom,
    //         ':prenom' => $this->prenom,
    //         ':age' => $this->age,
    //         ':nom_utilisateur' => $this->username,
    //         ':profession' => $this->job,
    //         ':type_de_magie' => $this->TypeOfMagic,
    //         ':maison' => $this->House
    //      ]);
    //
    //     if (!$executed) throw new \Error('Insert Failed');
    //
    //     $this->id = $this->conn->lastInsertId();
    // }

    public function update()
    {
        if (!$this->id) throw new \Error('Instances does not exist in base');

        $query = $this->conn->prepare('UPDATE profils SET nom_utilisateur=:nom_utilisateur, maison =:maison, description = :description  WHERE id = :id');
        $executed = $query->execute
        ([
            ':nom_utilisateur' => $this->username,
            ':maison' => $this->House
        ]);

        if (!$executed) throw new \Error('Update Failed');
    }

    public function hydrate(Array $element)
    {
        $this->id = $element['id'];
        $this->username = $element['nom_utilisateur'];
        $this->password = $element['mot_de_passe'] ?? null;
        $this->house = $element['maison'];
        $this->description = $element['description'] ?? null;
    }

    public function BiDrate(Array $element){
      $this->username = $element['nom_utilisateur'];
      $this->password = $element['mot_de_passe'];
    }
}
