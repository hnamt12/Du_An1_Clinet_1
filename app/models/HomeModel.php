<?php
namespace App\Models;
use App\Models\BaseModel;

class HomeModel extends BaseModel
{

    protected $table = 'products';

    public function getAllProduct()
    {
        $sql = "
        SELECT 
            p.product_id                id,
            p.category_id               category_id,
            p.name                      name,
            p.description               description,
            p.price                     price,
            c.category_id               c_id,
            c.name                      c_name,
            pi.image_id                 p_i_id ,
            pi.product_id               p_i_product_id ,
            pi.image_path               p_i_image_path
            
        FROM products p
        JOIN categories c ON c.category_id = p.category_id
        JOIN product_images pi on pi.product_id = p.product_id
        ORDER BY p.product_id DESC
    ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getByID($id)
    {
        $sql = "
        SELECT 
            p.product_id                id,
            p.category_id               category_id,
            p.name                      name,
            p.description               description,
            p.price                     price,
            c.category_id               c_id,
            c.name                      c_name,
            pi.image_id                 p_i_id ,
            pi.product_id               p_i_product_id ,
            pi.image_path               p_i_image_path
            
        FROM products p
        JOIN categories c ON c.category_id = p.category_id
        JOIN product_images pi on pi.product_id = p.product_id
        WHERE p.product_id = :id ;
    ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['id'=>$id]);

        return $stmt->fetch();
    }

}