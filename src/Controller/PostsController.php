<?php

namespace App\Controller;
use GuzzleHttp\Client;

class PostsController {

  public function single(){

    $loader = new \Twig\Loader\FilesystemLoader('views');
    $twig = new \Twig\Environment($loader);
    
    $client = new Client([
        'base_uri' => 'https://jsonplaceholder.typicode.com',
    ]);

    $response = $client->request('GET', 'posts/1');
    $body = $response->getBody();
    $post = json_decode($body->getContents());
    
    echo $twig->render('single.html.twig', [
      'post' => $post
    ]);

  }

}