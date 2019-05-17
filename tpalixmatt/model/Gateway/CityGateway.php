<?php

namespace Model\Gateway;

use App\Src\App;

class CityGateway
{
    private $conn;

    private $id;

    private $name;

    private $country;

    private $life;

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
    public function getName()
    {
        return $this->name;
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
        $query = $this->conn->prepare('INSERT INTO city (name, country, life) VALUES (:name, :coutry, :life)');
        $executed = $query->execute
        ([
            ':name' => $this->name,
            ':country' => $this->country,
            ':life' => $this->life
         ]);

        if (!$executed) throw new \Error('Insert Failed');

        $this->id = $this->conn->lastInsertId();
    }

    public function update() : void
    {
        if (!$this->id) throw new \Error('Instances does not exist in base');

        $query = $this->conn->prepare('UPDATE city SET name = :name, country = :country, life = :life WHERE id = :id');
        $executed = $query->execute
        ([
            ':name' => $this->name,
            ':country' => $this->country,
            ':life' => $this->life,
            ':id' => $this->id
        ]);

        if (!$executed) throw new \Error('Update Failed');
    }

    public function hydrate(Array $element)
    {
        $this->id = $element['id'];
        $this->name = $element['name'];
        $this->country = $element['country'];
        $this->life = $element['life'];
    }
}