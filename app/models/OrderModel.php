<?php
namespace App\Models;

class OrderModel extends BaseModel
{
    protected $table = 'orders';

    public function createOrder($data)
    {
        return $this->insert($data);
    }

    public function addOrderItem($orderId, $productId, $quantity, $price)
    {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $price
        ]);
    }
    public function getOrderDetails($orderId)
    {
        $query = "SELECT * FROM {$this->table} WHERE order_id = :order_id";
        return $this->find($query, ['order_id' => $orderId]);
    }
    public function getOrderItems($orderId)
    {
        $query = "SELECT oi.*, p.product_name, p.product_image 
                  FROM order_items oi
                  JOIN products p ON oi.product_id = p.product_id
                  WHERE oi.order_id = :order_id";
        return $this->select($query, ['order_id' => $orderId]);
    }
    public function updateOrderStatus($orderId, $status)
    {
        $query = "UPDATE {$this->table} SET status = :status WHERE order_id = :order_id";
        return $this->update($query, [
            'status' => $status,
            'order_id' => $orderId
        ]);
    }


}