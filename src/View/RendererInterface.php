<?php
namespace App\View;

interface RendererInterface {

  public function render(string $template, array $data ) : string;

}