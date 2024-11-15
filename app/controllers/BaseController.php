<?php
// include_once 'vendor/eftec/bladeone/lib/BladeOne.php';
namespace App\Controllers;
use eftec\bladeone\BladeOne;
class BaseController{
    function view($viewFile, $data = []){
        $views = "./app/views";
        $cache = "./app/cache";
        $blade = new BladeOne($views,$cache, BladeOne::MODE_DEBUG);
        echo $blade->run($viewFile, $data);
    }

}


