<?php
/**
 * Created by PhpStorm.
 * User: kristengarnier
 * Date: 2019-03-27
 * Time: 09:26
 */
 
 namespace Controller;
 
require_once ('ControllerBase.php');

class CountryController extends ControllerBase
{
    public function __construct($model) {
        parent::__construct($model);
    }

    public function countriesHandler() {
        $countries = $this->model->findAllCountries();
        $this->render('countries', ['countries' => $countries]);
    }

    public function countryHandler($country) {
        if(!$country) {
            $this->render('404');
        }
//        $country = $_GET['name'];

        $cities = $this->model->findAByCountry($country);

        if(count($cities) === 0) {
            $this->render('404');
        }

        $this->render('country', ['cities' => $cities, 'country' => $country]);
    }
}