<?php


namespace Model\Finder;
use App\Src\App;
use Model\Finder\FinderInterface;
use Model\Gateway\ProfilsGateway;

class ProfilFinder implements FinderInterface
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
        $query = $this->conn->prepare('SELECT p.id, p.nom, p.prenom, p.nom_utilisateur, p.age, p.profession, p.type_de_magie, p.maison FROM profils p ORDER BY p.nom_utilisateur'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute(); // Exécution de la requête
        $elements = $query->fetchAll(\PDO::FETCH_ASSOC);

        if (count($elements)== 0) return null;

        $profils = [];
        $profil = null;

        foreach ($elements as $element)
        {
            $profil = new ProfilsGateway($this->app);
            $profil->hydrate($element);

            $profils[] = $profil;
        }

        return $elements;
    }

    public function findOneById($id)
    {
        // TODO: Implement findByOneById() method.
        $query = $this->conn->prepare('SELECT p.id, p.nom, p.prenom, p.nom_utilisateur, p.age, p.profession, p.type_de_magie, p.maison FROM profils p WHERE p.id = :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        $elements = $query->fetch(\PDO::FETCH_ASSOC);
		
		
        if (count($elements)== 0) return null;

        $profil = new ProfilsGateway($this->app);
        $profil->hydrate($elements);


        return $profil;
    }
}