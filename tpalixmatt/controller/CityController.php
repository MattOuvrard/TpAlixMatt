<?php
/**
 * Created by PhpStorm.
 * User: kristengarnier
 * Date: 2019-02-28
 * Time: 15:10
 */
namespace Controller;
use App\Src\App;
use Controller\ControllerBase;
use Model\Finder\CityFinder;

class CityController extends ControllerBase
{
    public function __construct(App $app) {
        parent::__construct($app);
        session_start();
    }

    public function citiesHandler() {
        if($_SESSION['flash']) {
            $flash = urldecode($_SESSION['flash']);
        }

        $_SESSION['flash'] = null;

        $cities = $this->app->getService('cityFinder')->findAll();
        $this->app->getService('render')('cities', ["cities" => $cities, 'flash' => $flash ?? null]);
    }

    public function cityHandler($id) {
        if(!$id) {
            $this->render('404');
        }

        $city = $this->app->getService('cityFinder')->findOneById($id);
        $this->app->getService('render')('city', ['city' => $city]);
    }

    public function createHandler() {
        $this->app->getService('render')('createCity');
    }

    public function createDBHandler() {
        try { // on utilise un try catch pour renvoyer vers une erreur si la requête n'a pas fonctionné
            $city = [
                'name' => $_POST['name'],
                'country' => $_POST['country'],
                'life' => $_POST['life']
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

    public function searchHandler($cityName) {
        if(!$cityName) { // On vérfie si la référence est bien passée
            $this->app->getService('render')('404');
        }


        $cities = $this->app->getService('cityModel')->search($cityName);
        $this->app->getService('render')('cities', ['cities' => $cities]);
    }
}