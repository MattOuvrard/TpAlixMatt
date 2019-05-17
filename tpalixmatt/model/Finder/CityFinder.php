<?php


namespace Model\Finder;
use App\Src\App;
use Model\Finder\FinderInterface;
use Model\Gateway\CityGateway;

class CityFinder implements FinderInterface
{
    private $conn;
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->conn = $this->app->getService('database')->getConnection();
    }

    public function findAll()
    {
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c ORDER BY c.name'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        $elements = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (count($elements)== 0) return null;

        $cities = [];
        $city = null;

        foreach ($elements as $element)
        {
            $city = new CityGateway($this->app);
            $city->hydrate($element);

            $cities[] = $city;
        }

        return $elements;
    }

    public function findOneById($id)
    {
        // TODO: Implement findByOneById() method.
        $query = $this->conn->prepare('SELECT c.id, c.name, c.country, c.life FROM city c WHERE c.id = :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        $elements = $query->fetch(\PDO::FETCH_ASSOC);

        if (count($elements)== 0) return null;

        $city = new CityGateway($this->app);
        $city->hydrate($elements);


        return $city;
    }
}