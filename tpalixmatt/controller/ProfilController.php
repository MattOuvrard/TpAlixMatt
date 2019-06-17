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

  //C'est le signup
	public function LogInOK(){
		$this->app->getService('render')('signup');
	}

//Affiche tout les profils
    public function ProfilsHandler() {
        if($_SESSION['flash']) {
            $flash = urldecode($_SESSION['flash']);
        }

        $_SESSION['flash'] = null;

        $Profils = $this->app->getService('ProfilFinder')->findAll();
        $this->app->getService('render')('profils', ["profils" => $Profils, 'flash' => $flash ?? null]);
    }

//trouve un profil par son id
    public function ProfilHandler($id) {
        if(!$id) {
            $this->render('404');
        }
        if($id != $_SESSION['uId']){// a modifier mais pour l'instant c'est la sécurité qui permet de ne pas allé sur le profil de quelqu'un que tu ne t'ai pas enregistré
            $this->redirect('/Sorcier_Twitter/');
        }

        $profil = $this->app->getService('ProfilFinder')->findOneById($id);
        $tweet = $this->app->getService('ProfilFinder')->mesTweet($id);
        $this->app->getService('render')('myProfil', ['profil' => $profil, 'tweet' => $tweet]);
    }

//trouve et affiche un profil par son nom
    public function ProfilHandlerN($username) {
        if(!$username) {
            $this->render('404');
        }

        $profil = $this->app->getService('ProfilFinder')->findOneByName($username);
        $this->app->getService('render')('myProfil', ['myProfil' => $profil]);
    }

	public function verif(){

			if (isset($_POST['submit']))
		{
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);


			if (empty($username) || empty($password))
			{
                $this->app->getService('render')('login');
			}
			else
			{
                $profil = $this->app->getService('ProfilFinder')->findOneByName($username);

				if ($profil == null)
				{
				$this->app->getService('render')('login');
				}
				else
				{
						$passwordCheck = password_verify($password, $profil->getPassword());

						if ($passwordCheck == false)
						{
							$this->app->getService('render')('login');
						}
						else
						{
							$_SESSION['uId'] = $profil->getId();
							$_SESSION['uUsername'] = $profil->getUserName();
                            $this->redirect('/Sorcier_Twitter/myProfil/' . $_SESSION['uId']);
					    }
				}
			}
		}
		else
		{
			$this->app->getService('render')('login');
		}
	}

  public function createProfils() {
    if (isset($_POST['submit']))
    {
         $profil = [
             'username' => htmlspecialchars($_POST['username']),
             'password' => htmlspecialchars($_POST['password'])
           ];
           //si c'est vide
          if(empty($profil['username']) || empty($profil['password'])){
              $this->redirect('/Sorcier_Twitter/signup');
            }
           //si les caractère sont invalide
            if (!preg_match("/^[a-zA-Z]*$/", $profil['username']))
           {
             $this->redirect('/Sorcier_Twitter/signup');
           }

           //verifi que le nom n'existe pas dans la base de donné
           $fet = $this->app->getService('ProfilFinder')->DoMyUserExists($profil['username']);
           if(!$fet) {

              $profil['password'] = password_hash($profil['password'], PASSWORD_DEFAULT);
              $this->app->getService('ProfilFinder')->save($profil);
              $_SESSION['flash'] = $flash = "New profil created";
              $this->redirect('/Sorcier_Twitter/');

            }else{
             $this->redirect('/Sorcier_Twitter/signup');
           }
       } else {
         $this->redirect('/Sorcier_Twitter/signup');
       }
  }

  public function tweet()
  {
      $tweet = [
          'tweet' => htmlspecialchars($_POST['tweet']),
          'id' => $_SESSION['uId']
      ];

      $this->app->getService('ProfilFinder')->postTweet($tweet);
      $this->redirect('/Sorcier_Twitter/myProfil/' . $_SESSION['uId']);
  }

  public function logout(){
        $_SESSION['uId'] = null;
        $_SESSION['uUsername'] = null;
        session_destroy();
        $this->redirect('/Sorcier_Twitter/');
    }

    public function ProfilHandlerOther($id) {
        if(!$id) {
            $this->render('404');
        }

        $profil = $this->app->getService('ProfilFinder')->findOneById($id);
        $tweet = $this->app->getService('ProfilFinder')->mesTweet($id);
        $this->app->getService('render')('otherProfil', ['profil' => $profil, 'tweet' => $tweet]);
    }

  public function follow($otherId)
  {
      if(!$otherId) {
          $this->render('404');
      }

      $idFollow =
          [
              'myId' => $_SESSION['uId'],
              'otherId' => $otherId
          ];

      $this->app->getService('ProfilFinder')->makeFollow($idFollow);
      $this->redirect('/Sorcier_Twitter/myProfil/' . $_SESSION['uId']);
  }

  public function search()
  {
      $profilName = htmlspecialchars($_POST['search']);

      $nameProfil = $this->app->getService('ProfilFinder')->findOneByName($profilName);

      if ($nameProfil == null)
          $this->redirect('/Sorcier_Twitter/myProfil/' . $_SESSION['uId']);

      $this->redirect('/Sorcier_Twitter/otherProfil/' . $nameProfil->getId());
  }

  public function retweet($id)
  {
      if(!$id) {
          $this->render('404');
      }

      $this->app->getService('ProfilFinder')->makeRetweet($id);
      $this->redirect('/Sorcier_Twitter/myProfil/' . $_SESSION['uId']);
  }

  public function editProfil($id)
  {
      if(!$id) {
          $this->render('404');
      }

      if($id != $_SESSION['uId']){// a modifier mais pour l'instant c'est la sécurité qui permet de ne pas allé sur le profil de quelqu'un que tu ne t'ai pas enregistré
          $this->redirect('/Sorcier_Twitter/myProfil/' . $_SESSION['uId']);
      }

      $profil = $this->app->getService('ProfilFinder')->findOneById($id);
      $this->app->getService('render')('editProfil', ['profil' => $profil]);
  }

    public function editDescription($id)
    {
        $description = htmlspecialchars($_POST['description']);

        if(!$id) {
            $this->render('404');
        }

        if($id != $_SESSION['uId']){// a modifier mais pour l'instant c'est la sécurité qui permet de ne pas allé sur le profil de quelqu'un que tu ne t'ai pas enregistré
            $this->redirect('/Sorcier_Twitter/myProfil/' . $_SESSION['uId']);
        }

        $this->app->getService('ProfilFinder')->editDescription($id, $description);
        $profil = $this->app->getService('ProfilFinder')->findOneById($id);
        $this->app->getService('render')('editProfil', ['profil' => $profil]);
    }

    public function editHouse($id)
    {
        $house = htmlspecialchars($_POST['house']);

        if(!$id) {
            $this->render('404');
        }

        if($id != $_SESSION['uId']){// a modifier mais pour l'instant c'est la sécurité qui permet de ne pas allé sur le profil de quelqu'un que tu ne t'ai pas enregistré
            $this->redirect('/Sorcier_Twitter/myProfil/' . $_SESSION['uId']);
        }

        $this->app->getService('ProfilFinder')->editHouse($id, $house);
        $profil = $this->app->getService('ProfilFinder')->findOneById($id);
        $this->app->getService('render')('editProfil', ['profil' => $profil]);
    }



    //les images
    public function brique(){
      $this->app->getService('image')('brique');
    }
    public function journal(){
      $this->app->getService('image')('journal');
    }

    public function getHouseImage($house){
      $this->app->getService('image')($house);
    }

    public function police(){
      $this->app->getService('police');
    }


}
