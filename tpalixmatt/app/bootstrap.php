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
use Model\CityModel;
use Model\Finder\CityFinder;

$container = new ServiceContainer();
$app = new  App($container);

$app->setService('database', new Database
(
    "127.0.0.1",
    "citytowns",
    "root",
    "",
    "3306"
));

$app->setService('cityFinder', new CityFinder($app));

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

$routing = new  Routing($app);
$routing->setup();

return $app;