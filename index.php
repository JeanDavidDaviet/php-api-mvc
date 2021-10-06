<?php

require 'vendor/autoload.php';

use App\Controller\HomeController;
use App\ControllerFinder;
use App\Router;

$router = new Router();

if(isset($action)){

  $controllerFinder = new ControllerFinder();
  $router->findController($controllerFinder);
  
}else{

  $controller = new HomeController();
  $controller->index();
  
}

