<?php
namespace App;

use App\Src\App;
//require_once __DIR__ . '/src/App.php ';
//require_once __DIR__ . '/Routing.php';

$app = new App();
$routing = new Routing($app);
$routing->setup();

return $app;