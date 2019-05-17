<?php

namespace App;

use Controller\CityController;
Use Model\CityModel;
use Database\Database; 
use App\Src\App; 
 //require_once __DIR__ . '/../database/db.php';
 //require_once __DIR__ . '/../model/cities.php';
 //require_once __DIR__ . '/../controller/CityController.php';
 //require_once __DIR__ . '/../controller/CountryController.php';
 




class Routing{
	private $app;
	
	public function __construct(App $app){
		$this->app = $app;
	}
	
	public function setup(){
		$this->app->get('/', function(){
			//$model = new CityModel($this->setupDatabase());
			$controller = new CityController($this->setModel('Model\CityModel', $this->setupDatabase()));
			$controller->citiesHandler();
		});
		
		$this->app->get('/city/(\d+)', function($id){
			//$model = new CityModel($this->setupDatabase());
			$controller =  new CityController($this->setModel('Model\CityModel', $this->setupDatabase()));
			$controller->cityHandler($id);
		});
		
		$this->app->get('/country/' , function(){
			$controller = new CountryController($this->setModel('Model\CityModel', $this->setupDatabase()));
			$controller->countriesHandler();
		});
		
		$this->app->get('/country/(\w+)', function($country){
			$controller = new CountryController($this->setModel('Model\CityModel', $this->setupDatabase()));
			$controller->countryHandler($country);
		});
		$this->app->get('/search/', function(){
			$controller = new CityController($this->setModel('Model\CityModel', $this->setupDatabase()));
			$controller->searchHandler();
		});
		
		$this->app->get('/createCity/' , function(){
			$controller = new CityController($this->setModel('Model\CityModel', $this->setupDatabase()));
			$controller->createHandler();
		});
		
		$this->app->post('/createDBHandler/' , function(){
			$controller = new CityController($this->setModel('Model\CityModel', $this->setupDatabase()));
			$controller->createDBHandler();
		});
		
	}
	private function setupDatabase(): Database{
			return new Database(
				 "127.0.0.1",
				 "citytowns",
				 "root",
				 "",
				 "3306"
			 );		
	}
	
	private function setModel(string $modelName, Database $database){
		return new $modelName($database);	
	}
}