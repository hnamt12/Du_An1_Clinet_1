<?php 
namespace App\Controllers;

class TestLogin extends BaseController{
    public function index(){
        // $products = $this->home->getAllProduct();
        // debug($products); 
        // die ; 
        return $this->view('products.index') ; 
    }
}
