<?php

require 'vendor/autoload.php';

use App\Controller\HomeController;
use App\Controller\PostsController;

$path = $_SERVER['REQUEST_URI'];
if($path === '/single/1'){
  $controller = new PostsController();
  $controller->single();
}else{
  $controller = new HomeController();
  $controller->index();
}