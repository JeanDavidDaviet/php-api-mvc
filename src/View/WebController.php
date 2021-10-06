<?php

namespace App\View;

use GuzzleHttp\ClientInterface;
use Twig\Environment;

class WebController {

  public function __construct(protected Environment $renderer, protected ClientInterface $client) { }

}