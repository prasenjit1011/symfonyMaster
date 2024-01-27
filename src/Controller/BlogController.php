<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BlogController{
    
	private $apiHostUrl = 'https://jsonplaceholder.typicode.com';	
    public function __construct(private HttpClientInterface $client)
    {

    }

	private function fetchData($pageUrl){
		$result = [];
		try{
			$response = $this->client->request(
				'GET',
				$this->apiHostUrl.'/'.$pageUrl
			);

			$result['statusCode']	= $response->getStatusCode();
			$contentType			= $response->getHeaders()['content-type'][0];
			$contentType			= explode(';', $contentType);
			$result['contentType']	= $contentType[0];
			$result['charset']		= explode('=', $contentType[1])[1];
			$result['data'] 		= $response->toArray();
		}
		catch(\Exception $ex){
			$result = ["statusCode"=>500, "contentType" => "application/json", "msg"=>"500 Server Error Occured"];
		}

		return $result;
	}

    #[Route('/')]
    public function details($hello = null): Response
    {
		return new Response('Hello World');
    }

	#[Route('/users')]
    public function users(): Response
    {
		$result = $this->fetchData('users');
		return new Response(json_encode($result));
    }

	#[Route('/users/{userId}/posts')]
    public function posts($userId = null): Response
    {
		$result = $this->fetchData('posts?userId='.$userId);
		return new Response(json_encode($result));
    }
	
	#[Route('/posts/{postId}/comments')]
    public function comments($postId = null): Response
    {
		$result = $this->fetchData('comments?postId='.$postId);
		return new Response(json_encode($result));
    }





}