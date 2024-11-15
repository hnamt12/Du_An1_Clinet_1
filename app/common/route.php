<?php
use Phroute\Phroute\RouteCollector;
use App\Controllers\BaseController;


$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();

//bắt đầu định nghĩa ra các đường dẫn
// $router->get('/', function(){
//     return $this->base->view('index');
// });
$router->get('/',[App\Controllers\HomeController::class,"index"]) ;
$router->get('detail',[App\Controllers\HomeController::class,"details"]) ;



# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;


?>