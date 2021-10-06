<?php

namespace App\Controller;
use GuzzleHttp\Client;

class HomeController {

  public function index(){

    $loader = new \Twig\Loader\FilesystemLoader('views');
    $twig = new \Twig\Environment($loader);
    
    $client = new Client([
        'base_uri' => 'https://jsonplaceholder.typicode.com',
    ]);

    $response = $client->request('GET', 'posts');
    $body = $response->getBody();
    $posts = json_decode($body->getContents());

    echo $twig->render('index.html.twig', [
      'posts' => $posts
    ]);


  }

}