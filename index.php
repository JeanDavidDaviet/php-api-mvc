<?php

require 'vendor/autoload.php';

use App\Controller\HomeController;
use App\Routing\ControllerFinder;
use App\Routing\Router;

$router = new Router();
$controllerFinder = new ControllerFinder(dirname(__FILE__) . '/src/controller');

try {
  $router->findController($controllerFinder);
}catch(Exception $e){
  $controller = new HomeController();
  $controller->index();
}
