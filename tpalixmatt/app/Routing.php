<?php
/**
 * Created by PhpStorm.
 * User: Alix
 * Date: 2019-04-04
 * Time: 12:11
 */
namespace App;

use Controller\CityController;
use Controller\CountryController;
use Model\CityModel;
use Database\Database;
use App\Src\App;



class Routing
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function setup()
    {
        $app = $this->app;
        $this->app->get('/', function () use ($app)
        {
            $controller =  new CityController($app);
            $controller->citiesHandler();
        });

        $this->app->get('/city/(\d+)', function ($id) use ($app)
        {
            $controller =  new CityController($app);
            $controller->cityHandler($id);
        });

        $this->app->get('/recherche/(\w+)', function ($city) use ($app)
        {
            $controller =  new CityController($app);
            $controller->searchHandler($city);
        });

        $this->app->get('/create/', function () use ($app)
        {
            $controller =  new CityController($app);
            $controller->createHandler();
        });

        $this->app->get('/countries/', function () use ($app)
        {
            $controller =  new CountryController($app);
            $controller->countriesHandler();
        });

        $this->app->get('/countries/country/(\w+)', function ($countryName) use ($app)
        {
            $controller =  new CountryController($app);
            $controller->countryHandler($countryName);
        });

        $this->app->get('/countries/country/city/(\d+)', function ($id) use ($app)
        {
            $controller =  new CityController($app);
            $controller->cityHandler($id);
        });

        $this->app->post('/create/handleCreate/', function () use ($app)
        {
            $controller =  new CityController($app);
            $controller->createDBHandler();
        });
    }
}