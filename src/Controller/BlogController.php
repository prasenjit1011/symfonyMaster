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
    public function homepage(): Response
    {
        return new Response('Post Listing Page');
    }

    #[Route('/details/{hello}')]
    public function details($hello = null): Response
    {
        return new Response('Details page of '.$hello);
    }

    #[Route('/fetchGitHubInformation')]
    public function fetchGitHubInformation()//: array
    {
        //return new Response('fetchGitHubInformation');
        
        $response = $this->client->request(
            'GET',
            'https://api.github.com/repos/symfony/symfony-docs'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return new Response(json_encode($content));
        
    }
}