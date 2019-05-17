<?php
/**
 * Created by PhpStorm.
 * User: kristengarnier
 * Date: 2019-02-28
 * Time: 15:10
 */

 namespace Controller;
 
 
require_once ('ControllerBase.php');

class CityController extends ControllerBase
{
    public function __construct($model) {
        parent::__construct($model);
    }

    public function citiesHandler() {
        // if(key_exists('flash', $_GET)) {
            // $flash = urldecode($_GET['flash']);
        // }

        // $cities = $this->model->findAll();
        // $this->render('cities', ["cities" => $cities, 'flash' => $flash ?? null]);
		$cities = $this->model->findAll();
		$this->render('cities', ["cities" => $cities]);
    }

    public function cityHandler($id) {
        if(!$id) {
            $this->render('404');
        }

        //$id = $_GET['id'];
		
        $city = $this->model->findOneById($id);
		
        $this->render('city', ['city' => $city]);
    }

    public function createHandler() {
        $this->render('createCity');
    }

    public function createDBHandler() {
        try { // on utilise un try catch pour renvoyer vers une erreur si la requête n'a pas fonctionné
            $city = [
                'name' => $_POST['name'],
                'country' => $_POST['country'],
                'life' => $_POST['life']
            ];

            $result = $this->model->save($city);

            if(!$result) {
                $this->render('createCity', ['city' => $city, 'error' => true]);
            }

            $flash = "New city has been sucessfully created";
            $this->redirect('/tp1_php/');

        } catch (Exception $e) {
            $this->render('createCity', ['city' => $city, 'error' => $e]);
        }
    }

    public function searchHandler($search) {
        if(!$search) { // On vérfie si la référence est bien passée
            $this->render('404');
        }

        //$search = $_GET['search'];

        $cities = $this->model->search($search);

        $this->render('cities', ['cities' => $cities]);
    }


	
	}