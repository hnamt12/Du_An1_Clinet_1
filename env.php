<?php 

define('BASE_URL','http://localhost/Du_an1_Wd19306_Clinet_test/') ;
define('BASE_URL_ADMIN','http://localhost/Du_an1_Wd19306_test/') ;


define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'du_an1_wb19306_chatgpt_delete');
define('PATH_ROOT',         __DIR__ . '/../'); 
define('BASE_ASSETS_UPLOADS',   BASE_URL_ADMIN . 'app/uploads/');
define('PATH_ASSETS_UPLOADS',    'app/uploads/');
// define('PATH_ASSETS_UPLOADS',   PATH_ROOT . 'app/uploads/');

define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);



// const BASE_URL = "http://localhost/Du_an1_Wd19306_test/";


function route($url)
{
    return BASE_URL . $url;
}
// Cấu hình file kết nối csdl
   

?>