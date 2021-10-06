<?php

namespace App\Controller;

use App\View\RendererInterface;

class WebController {

  public function __construct(private RendererInterface $renderer) { }
}