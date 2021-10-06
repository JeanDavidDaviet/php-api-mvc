<?php

require 'vendor/autoload.php';

use App\Controller\HomeController;
use App\Routing\ControllerFinder;
use App\Routing\Router;
use GuzzleHttp\Client;

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);

$client = new Client([
  'base_uri' => 'https://jsonplaceholder.typicode.com',
]);

$router = new Router($twig, $client);
$controllerFinder = new ControllerFinder(dirname(__FILE__) . '/src/controller');

try {
  $router->findController($controllerFinder);
}catch(Exception $e){
  $controller = new HomeController($twig, $client);
  $controller->index();
}
