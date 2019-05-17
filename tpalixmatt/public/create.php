<?php
require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../model/cities.php';
require_once __DIR__ . '/../controller/CityController.php';

$Database = new Database(
    "127.0.0.1",
    "citytowns",
    "root",
    "",
    "3306"
);
$model = new CityModel($Database);
$controller =  new CityController($model);
$controller->createHandler();