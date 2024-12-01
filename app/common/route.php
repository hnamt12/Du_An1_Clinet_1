<?php
use App\Middlewares\AuthMiddleware;
use Phroute\Phroute\RouteCollector;
use App\Controllers\BaseController;


$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();

//bắt đầu định nghĩa ra các đường dẫn
// $router->get('/', function(){
//     return $this->base->view('index');
// });
// $router->get('/',[App\Controllers\HomeController::class,"index"]) ;

function applyMiddleware($router, $routeNames)
{
    foreach ($routeNames as $route) {
        $router->get($route, function () use ($route) {
            AuthMiddleware::handle(); // Kiểm tra đăng nhập trước khi truy cập route
            if ($route == 'products') {
                $controller = new App\Controllers\TestLogin(); // Thay bằng controller tương ứng
                return $controller->index();
            } elseif ($route == '') {
                $controller = new App\Controllers\HomeController();
                return $controller->index();
            } elseif ($route == 'products.deltail') {
                $controller = new App\Controllers\HomeController();
                return $controller->details();
            }
            elseif ($route == 'cart.index') {
                $controller = new App\Controllers\CartsController();
                return $controller->index();
            }
            elseif ($route == 'checkout.index') {
                $controller = new App\Controllers\CartsController();
                return $controller->indexcheckout();
            }
            elseif ($route == 'cart.update') {
                $controller = new App\Controllers\CartsController();
                return $controller->addToCart();
            }
            elseif ($route == 'thankyou') {
                $controller = new App\Controllers\CartsController();
                return $controller->thankyou();
            }
            



            // Thêm các route khác cần bảo vệ ở đây
        });
    }
}
// Các route cần kiểm tra đăng nhập
$protectedRoutes = ['products', '', 'products.deltail','cart.index','checkout.index','thankyou'];

// Áp dụng middleware AuthMiddleware cho các route này
applyMiddleware($router, $protectedRoutes);


// $router->get('cart.index',[App\Controllers\CartsController::class,"index"]) ;
// $router->get('productTest',[App\Controllers\CartsController::class,"index"]) ;
$router->post('cart.add',[App\Controllers\CartsController::class,"addToCart"]) ;
$router->post('cart.remove',[App\Controllers\CartsController::class,"removeFromCart"]) ;
$router->post('cart.update',[App\Controllers\CartsController::class,"updateQuantity"]) ;
$router->post('cart.updateQuantity',[App\Controllers\CartsController::class,"updateQuantity"]) ;
$router->post('checkout.placeOrder', [App\Controllers\CartsController::class, 'placeOrder']);
// $router->post('checkout', [App\Controllers\CartsController::class, 'checkout']);



// // login
$router->get('login', [App\Controllers\AuthController::class, 'showLoginForm']);
$router->post('login.action', [App\Controllers\AuthController::class, 'login']);
$router->get('/logout', [App\Controllers\AuthController::class, 'logout']);
// // $router->get('products', [App\Controllers\TestLogin::class, 'index']);


// check login 

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;


?>