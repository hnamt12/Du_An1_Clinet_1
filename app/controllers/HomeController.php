<?php 

namespace App\Controllers;
use App\Controllers\BaseController ; 
use App\Models\BaseModel ;
use App\Models\HomeModel;
// require_once "app/models/env.php" ; 

class HomeController extends BaseController{
    
    protected $home ; 

    public function __construct(){
        $this->home = new HomeModel() ;

    }
    public function index(){
        $products = $this->home->getAllProduct();
        // debug($products); 
        // die ; 
        return $this->view('layouts.main_conten',compact('products')) ; 
    }
    public function details(){
        $id=$_GET['id'];

        $product = $this->home->getByID($id);
        // debug($product); 
        // // die ; 
        // var_dump($product);
        return $this->view('layouts.products.product_detail.detail_main',compact('product')) ; 
    }
}
