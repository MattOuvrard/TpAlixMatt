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
use Controller\ProfilController;
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
            $controller =  new ProfilController($app);
            $controller->Login();
        });


		$this->app->get('/myProfil/(\d+)', function ($id) use ($app)
        {
           $controller =  new ProfilController($app);
           $controller->ProfilHandler($id);
        });

        $this->app->post('/profilCheck', function () use ($app)
            {
                $controller =  new ProfilController($app);
                $controller->verif();

            });

        $this->app->post('/signup/signcheck', function() use($app){
          $controller = new ProfilController($app);
          $controller->createProfils();
        });


        $this->app->get('/profils', function () use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->ProfilsHandler();
        });


        $this->app->get('/signup', function () use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->LogInOk();
        });

        $this->app->post('/tweet', function () use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->tweet();
        });

        $this->app->get('/logout', function() use ($app){
            $controller = new ProfilController($app);
            $controller->Logout();
        });

        $this->app->get('/otherProfil/(\d+)', function ($id) use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->ProfilHandlerOther($id);
        });

        $this->app->post('/follow/(\d+)', function ($id) use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->follow($id);
        });

        $this->app->post('/search', function () use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->search();
        });

        $this->app->post('/retweet/(\d+)', function ($id) use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->retweet($id);
        });

        $this->app->get('/editProfil/(\d+)', function ($id) use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->editProfil($id);
        });


        $this->app->post('/editDescription/(\d+)', function ($id) use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->editDescription($id);
        });

        $this->app->post('/editHouse/(\d+)', function ($id) use ($app)
        {
            $controller =  new ProfilController($app);
            $controller->editHouse($id);
        });

        $this->app->get('/brique', function () use($app){
          $controller = new ProfilController($app);
          $controller->brique();
        });
        $this->app->get('/journal', function() use ($app){
          $controller= new ProfilController($app);
          $controller->journal();
        });
        $this->app->get('/house/(\d+)', function($house)use($app){
          $controller =new ProfilController($app);
          $controller->getHouseImage($house);
        });

      $this->app->get('/police', function () use ($app){
        $controller = new ProfilController($app);
        $controller->police();
      });


    }
}
