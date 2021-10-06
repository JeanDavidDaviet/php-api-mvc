<?php

require 'vendor/autoload.php';

use App\Controller\HomeController;
use App\Controller\PostsController;

$path = $_SERVER['REQUEST_URI'];
$path = preg_replace('#\/?index\.php\/?#', '', $path);
$args = preg_split('#\/#', $path);
$args = array_values(array_filter($args));

if(!empty($args[0])){
  $action = trim($args[0]);
  $params = array_slice($args, 1);
}

// echo '<pre>';
// var_dump($action, $params);
// echo '</pre>';


if(isset($action)){

  $controllers = [
    'App\Controller\HomeController',
    'App\Controller\PostsController',
  ];

  foreach($controllers as $controller){

    $class = new ReflectionClass($controller);
    $methods = $class->getMethods();

    foreach($methods as $method){

      if($action === $method->name){
        
        $instancied = new $method->class;
        try {
          call_user_func_array(array($instancied, $action), $params);
        } catch(Exception $e){
          // echo '<pre>';
          // var_dump($e->getMessage());
          // echo '</pre>';
        }
        break;
      }
    }
  }
}else{
  $controller = new HomeController();
  $controller->index();
}

