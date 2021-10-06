<?php

namespace App\Controller;

use App\Exception\PostNotFoundException;
use GuzzleHttp\Client;

class PostsController {

  public function single($post_id = 0){

    if( ! $post_id ){

      throw new PostNotFoundException('post_id not found : ' . $post_id);

    }

    $loader = new \Twig\Loader\FilesystemLoader('views');
    $twig = new \Twig\Environment($loader);
    
    $client = new Client([
        'base_uri' => 'https://jsonplaceholder.typicode.com',
    ]);

    $response = $client->request('GET', 'posts/' . $post_id);
    $body = $response->getBody();
    $post = json_decode($body->getContents());
    
    echo $twig->render('single.html.twig', [
      'post' => $post
    ]);

  }

}