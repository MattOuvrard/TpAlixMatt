<?php
/**
 * Created by PhpStorm.
 * User: Alix
 * Date: 2019-04-04
 * Time: 12:04
 */
namespace web;
use App\Src\Autoloader;

require_once __DIR__ . '/../app/src/Autoloader.php';
Autoloader::register();

$app = require_once  __DIR__ . '/../app/bootstrap.php';
$app->run();