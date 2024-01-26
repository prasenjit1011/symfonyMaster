<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BlogController{
    
    public function __construct(private HttpClientInterface $client)
    {
        
    }

    #[Route('/')]
    public function details($hello = null): Response
    {
		return new Response('Hello World');
    }

	#[Route('/users')]
    public function users(): Response
    {
		$response = $this->client->request(
            'GET',
            'https://jsonplaceholder.typicode.com/users'
        );

        // $statusCode = $response->getStatusCode();
        // $statusCode = 200
        // $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        // $content = $response->getContent();
        
        $content = $response->toArray();
        return new Response(json_encode($content));
    }

	#[Route('/users/{userId}/posts')]
    public function posts($userId = null): Response
    {
		$response = $this->client->request(
            'GET',
            'https://jsonplaceholder.typicode.com/posts?userId='.$userId
        );
        
        $content = $response->toArray();
        return new Response(json_encode($content));
    }
	
	#[Route('/posts/{postId}/comments')]
    public function comments($postId = null): Response
    {
		$response = $this->client->request(
            'GET',
            'https://jsonplaceholder.typicode.com/comments?postId='.$postId
        );
        
        $content = $response->toArray();
        return new Response(json_encode($content));
    }
}