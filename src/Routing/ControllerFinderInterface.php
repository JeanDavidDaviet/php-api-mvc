<?php

interface ControllerFinderInterface {

  public function setControllers() : void;
  public function getControllers() : array;

}