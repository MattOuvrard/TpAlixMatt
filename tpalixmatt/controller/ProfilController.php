<?php
namespace Controller;
use App\Src\App;
use Controller\ControllerBase;
use Model\Finder\ProfilFinder;

class ProfilController extends ControllerBase
{
    public function __construct(App $app) {
        parent::__construct($app);
        session_start();
    }

	//method faignasse dossier racine
	public function Login(){
		$this->app->getService('render')('login');
	}
	public function LogInOK(){
		$this->app->getService('render')('signup');
	}
	

    public function ProfilsHandler() {
        if($_SESSION['flash']) {
            $flash = urldecode($_SESSION['flash']);
        }

        $_SESSION['flash'] = null;

        $Profils = $this->app->getService('ProfilFinder')->findAll();
        $this->app->getService('render')('profils', ["profils" => $Profils, 'flash' => $flash ?? null]);
    }

    public function ProfilHandler($id) {
        if(!$id) {
            $this->render('404');
        }

        $profil = $this->app->getService('ProfilFinder')->findOneById($id);
        $this->app->getService('render')('profil', ['profil' => $profil]);
    }

		public function createhandler() {//ici on appelle la page de 
			$this->app->getservice('render')('connection');
    }

     public function createProfil() {
        try { // on utilise un try catch pour renvoyer vers une erreur si la requête n'a pas fonctionné
            $city = [
                'nom_utilisateur' => $_POST['username'],
                'nom' => $_POST['Lastname'],
                'prenom' => $_POST['Firstname'],
				'age'=> $_POST['age'],
				'profession' => $_POST['profession'],
				'type_de_magie' => $_POST['Type_de_magie'],
				'maison' => $_POST['house']
            ];

            $result = $this->app->getService('cityModel')->save($city);

            if(!$result) {
                $this->app->getService('render')('createCity', ['city' => $city, 'error' => true]);
            }

            $_SESSION['flash'] = $flash = "New city has been sucessfully created";
            $this->redirect('/Test/');

        } catch (Exception $e) {
            $this->app->getService('render')('createCity', ['city' => $city, 'error' => $e]);
        }
    }

    public function searchHandler($ProfilName) {
        if(!$ProfilName) { // On vérfie si la référence est bien passée
            $this->app->getService('render')('404');
        }


        $cities = $this->app->getService('cityModel')->search($ProfilName);
        //$this->app->getService('render')('cities', ['cities' => $cities]);
    }
}