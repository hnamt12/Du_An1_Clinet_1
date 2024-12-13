<?php 
namespace   App\Models;

class OrderItemModel extends BaseModel {
    protected $table = 'order_items';

    // Thêm sản phẩm vào bảng order_items
    public function insertOrderItem($data)
    {
        return $this->insert($data);
    }
}