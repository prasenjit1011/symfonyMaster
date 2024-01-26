### Symfony master project

##### Install Symfony Project
composer create-project symfony/skeleton symfonyProject

##### Allow CORS Origin
composer require nelmio/cors-bundle
** Edit .env file or config\packages\nelmio_cors.yaml to define allow origin 

##### To run Symfony project 
php -S localhost:3100 -t public


##### API Urls List

http://localhost:3100/users

http://localhost:3100/posts?userId={userId}


http://localhost:3100/comments?postId={postId}


















