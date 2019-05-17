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
        $countries = $this->app->getService('cityModel')->findAllCountries();
        $this->app->getService('render')('countries', ['countries' => $countries]);
    }

    public function countryHandler($countryName) {
        if(!$countryName) {
            $this->app->getService('render')('404');
        }

        $cities = $this->app->getService('cityModel')->findAByCountry($countryName);

        if(count($cities) === 0) {
            $this->app->getService('render')('404');
        }

        $this->app->getService('render')('country', ['cities' => $cities, 'country' => $countryName]);
    }
}