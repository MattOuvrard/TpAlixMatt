<?php
/**
 * Created by PhpStorm.
 * User: kristengarnier
 * Date: 2019-02-28
 * Time: 14:59
 */
namespace Controller;

use App\Src\App;

abstract class ControllerBase
{
    /**
     * @var \CityModel
     */
    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }

    // protected function render(String $template, Array $params = []) {
    //
    //     if($template === '404') {
    //         header("HTTP/1.0 404 Not Found");
    //     }
    //
    //     ob_start();
    //     include __DIR__ . '/../view/' . $template . '.php';
    //     ob_end_flush();
    //     die();
    // }
    //
    protected function redirect($location) {
        header("Location: $location");
        die();
    }
}
