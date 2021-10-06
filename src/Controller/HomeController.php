<?php

namespace App\Controller;

use App\View\WebController;

class HomeController extends WebController {

  public function index(){

    $response = $this->client->request('GET', 'posts');
    $body = $response->getBody();
    $posts = json_decode($body->getContents());
    
    echo $this->renderer->render('index.html.twig', [
      'posts' => $posts
    ]);

  }

}