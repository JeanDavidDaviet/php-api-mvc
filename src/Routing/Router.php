<?php 

namespace App\Routing;

use App\Exception\NoActionFoundException;
use App\Routing\ControllerFinderInterface;
use GuzzleHttp\Client;
use ReflectionClass;

class Router {

  private string $action = '';
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

  public function findController(ControllerFinderInterface $controller_finder){
    if( ! $this->action ){
      throw new NoActionFoundException('Aucune action n\'est définie pour cette URL');
    }

    $controllers = $controller_finder->getControllers();

    foreach($controllers as $controller){

      $class = new ReflectionClass('App\\Controller\\' . $controller);
      $methods = $class->getMethods();
  
      foreach($methods as $method){
  
        if($this->action === $method->name){

          $loader = new \Twig\Loader\FilesystemLoader('views');
          $twig = new \Twig\Environment($loader);

          $client = new Client([
              'base_uri' => 'https://jsonplaceholder.typicode.com',
          ]);
          
          $instancied = new $method->class($twig, $client);

          call_user_func_array(array($instancied, $this->action), $this->params);
          break;
          
        }
      }
    }
  }

}