<?php

require 'vendor/autoload.php';

use App\Controller\HomeController;
use App\Controller\PostsController;

$path = $_SERVER['REQUEST_URI'];
if($path === '/single/1'){
  try {
    $controller = new PostsController();
    $controller->single();
  }catch(Exception $e){
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
  }
}else{
  $controller = new HomeController();
  $controller->index();
}