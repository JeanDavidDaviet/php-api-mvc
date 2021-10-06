<?php 

namespace App;

use ControllerFinderInterface;
use Exception;
use ReflectionClass;

class Router {

  private string $action;
  private array $params;

  public function __construct() {
    $this->getMethodAndParamsFromURL();
  }

  public function getMethodAndParamsFromURL(){
    $path = $_SERVER['REQUEST_URI'];
    $path = preg_replace('#\/?index\.php\/?#', '', $path);
    $args = preg_split('#\/#', $path);
    $args = array_values(array_filter($args));

    if(!empty($args[0])){
      $this->action = trim($args[0]);
      $this->params = array_slice($args, 1);
    }
  }

  public function findController(ControllerFinderInterface $controllers){
    foreach($controllers as $controller){

      $class = new ReflectionClass($controller);
      $methods = $class->getMethods();
  
      foreach($methods as $method){
  
        if($this->action === $method->name){
          
          $instancied = new $method->class;
          try {
            call_user_func_array(array($instancied, $this->action), $this->params);
          } catch(Exception $e){
            // echo '<pre>';
            // var_dump($e->getMessage());
            // echo '</pre>';
          }
          break;
        }
      }
    }
  }

}