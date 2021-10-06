<?php 

namespace App\Routing;

use App\Routing\ControllerFinderInterface;

class ControllerFinder implements ControllerFinderInterface {

  private array $controllers = [];
  private array $controllers_files = [];

  public function __construct(private string $controllers_path) {
    $this->controllers_files = scandir($controllers_path);
    $this->setControllers();
  }

  public function setControllers() : void {
    $this->controllers = str_replace('.php', '', array_diff($this->controllers_files, ['..', '.']));
  }

  public function getControllers() : array {
    return $this->controllers;
  }

}