<?php

namespace App\Controller;

use App\Exception\PostNotFoundException;
use GuzzleHttp\ClientInterface;
use Twig\Environment;

class PostsController {

  public function __construct(private Environment $renderer, private ClientInterface $client) { }

  public function single($post_id = 0){

    if( ! $post_id ){

      throw new PostNotFoundException('post_id not found : ' . $post_id);

    }

    $response = $this->client->request('GET', 'posts/' . $post_id);
    $body = $response->getBody();
    $post = json_decode($body->getContents());
    
    echo $this->renderer->render('single.html.twig', [
      'post' => $post
    ]);

  }

}