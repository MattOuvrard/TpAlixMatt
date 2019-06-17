<?php
/**
 * Created by PhpStorm.
 * User: Alix
 * Date: 2019-04-04
 * Time: 12:01
 */
namespace App;
use App\Src\App;
use App\Src\ServiceContainer\ServiceContainer;
use Database\Database;
/*use Model\CityModel;*/
use Model\Finder\ProfilFinder;

$container = new ServiceContainer();
$app = new  App($container);

$app->setService('database', new Database
(
    "127.0.0.1",
    "tpalixmatt",
    "root",
    "",
    "3306"
));

$app->setService('ProfilFinder', new ProfilFinder($app));

$app->setService('render', function (String $template, Array $params = [])
{
    if($template === '404') {
        header("HTTP/1.0 404 Not Found");
    }

    ob_start();
    include __DIR__ . '/../view/' . $template . '.php';
    ob_end_flush();
    die();
});

$app->setService('image' , function(String $url) {
  include __DiR__ . '/../view/image/'. $url . '.jpg';
  echo '/../image/'. $url . '.jpg';
});

$app->setService('police', function(){
  include __DiR__ . '/../view/image/HARRYP__.TTF';
  echo '/../view/image/HARRYP__.TTF';
});

$routing = new  Routing($app);
$routing->setup();

return $app;
