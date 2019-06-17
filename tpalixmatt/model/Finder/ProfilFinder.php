<?php


namespace Model\Finder;
use App\Src\App;
use Model\Finder\FinderInterface;
use Model\Gateway\ProfilsGateway;
use Database;

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
        $query = $this->conn->prepare('SELECT p.id, p.nom_utilisateur, p.maison FROM profils p ORDER BY p.nom_utilisateur'); // Création de la requête + utilisation order by pour ne pas utiliser sort
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
        $query = $this->conn->prepare('SELECT p.id, p.nom_utilisateur, p.maison, p.description FROM profils p WHERE p.id = :id'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]); // Exécution de la requête
        $elements = $query->fetch(\PDO::FETCH_ASSOC);

        if (count($elements)== 0) return null;

        $profil = new ProfilsGateway($this->app);
        $profil->hydrate($elements);


        return $profil;
    }

    public function findOneByName($name){
      $query = $this->conn->prepare('SELECT p.id, p.nom_utilisateur, p.maison, p.mot_de_passe FROM profils p WHERE p.nom_utilisateur = :name'); // Création de la requête + utilisation order by pour ne pas utiliser sort
      $query->execute([':name' => $name]); // Exécution de la requête
      $elements = $query->fetch(\PDO::FETCH_ASSOC);

      if (!isset($elements) || !$elements)
          return null;

      $profil = new ProfilsGateway($this->app);
      $profil->hydrate($elements);


      return $profil;
    }


    public function save(Array $profils){
      $query = $this->conn->prepare('INSERT INTO profils (nom_utilisateur, mot_de_passe) VALUES (:nom_utilisateur, :mot_de_passe)'); // Création de la requête + utilisation order by pour ne pas utiliser sort
      return $query->execute([
          ':nom_utilisateur' => $profils['username'],
          ':mot_de_passe' => $profils['password']
      ]);


    }

    public function DoMyUserExists($name) : Bool
    {
        $exist = $this->findOneByName($name);

        if ($exist instanceof ProfilsGateway)
            return true;

        return false;
    }

    public function postTweet(Array $tweet)
    {
        $query = $this->conn->prepare('INSERT INTO tweet (contenu, auteur_id, date) VALUES (:contenu, :id, NOW())');
        $query->execute([
            ':contenu' => $tweet['tweet'],
            ':id' => $tweet['id']
        ]);
    }

    public function mesTweet($id) : Array
    {
        $query = $this->conn->prepare('SELECT t2.* FROM
(	
    SELECT t.auteur_id, t.contenu, t.date, t.nb_retweet, t.id, p.nom_utilisateur
	FROM tweet t
	INNER JOIN profils p ON p.id = t.auteur_id
	WHERE t.auteur_id = :id
    UNION
        SELECT t.auteur_id, t.contenu, t.date, t.nb_retweet, t.id, p.nom_utilisateur
        FROM follow f
        INNER JOIN tweet t ON t.auteur_id = f.suivi_id
        INNER JOIN profils p ON p.id = f.suivi_id
        WHERE f.utilisateur_id = :id
) AS t2 ORDER BY t2.date DESC'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([':id' => $id]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function makeFollow(Array $idFollow)
    {
        $query = $this->conn->prepare('SELECT f.utilisateur_id, f.suivi_id FROM follow f WHERE f.utilisateur_id = :uId AND f.suivi_id = :sId'); // Création de la requête + utilisation order by pour ne pas utiliser sort
        $query->execute([
            ':uId' => $idFollow['myId'],
            ':sId' => $idFollow['otherId']
        ]);
        $elements = $query->fetch(\PDO::FETCH_ASSOC);
        if ($elements)
            return null;

        $query = $this->conn->prepare('INSERT INTO follow (utilisateur_id, suivi_id) VALUES (:uId, :sId)');
        $query->execute([
            ':uId' => $idFollow['myId'],
            ':sId' => $idFollow['otherId']
        ]);
    }

    public function makeRetweet($id)
    {
        $query = $this->conn->prepare('UPDATE tweet t SET t.nb_retweet = t.nb_retweet + 1 WHERE t.id = :id');
        $query->execute([':id' => $id]);
    }

    public function editDescription(int $id, string $description)
    {
        $query = $this->conn->prepare('UPDATE profils p SET p.description = :description WHERE p.id = :id');
        $query->execute([':id' => $id, ':description' => $description]);
    }

    public function editHouse(int $id, string $house)
    {
        $query = $this->conn->prepare('UPDATE profils p SET p.maison = :house WHERE p.id = :id');
        $query->execute([':id' => $id, ':house' => $house]);
    }
}
