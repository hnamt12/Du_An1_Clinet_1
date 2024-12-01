<?php

namespace App\Models;

use App\Models\BaseModel;

class CartsModel extends BaseModel
{
    protected $table = 'cart';

    // Lấy giỏ hàng của người dùng
    public function getCartItems($userId)
    {
        $sql = "
            SELECT co.cart_order_id, 
            p.name, 
            p.price, 
            co.quantity, 
            p.product_id,
            pi.product_id               p_i_product_id ,
            pi.image_path               p_i_image_path,

            (co.quantity * p.price) as total_price 
            FROM cart c
            JOIN cartorder co ON c.cart_id = co.cart_id
            JOIN products p ON co.product_id = p.product_id
            JOIN product_images pi on pi.product_id = p.product_id
            WHERE c.user_id = :user_id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($userId, $productId, $quantity)
    {
        $sql = "SELECT * FROM cart WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $cart = $stmt->fetch();

        if (!$cart) {
            // Tạo giỏ hàng mới nếu chưa có
            $sql = "INSERT INTO cart (user_id) VALUES (:user_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            $cartId = $this->pdo->lastInsertId();
        } else {
            $cartId = $cart['cart_id'];
        }

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $sql = "SELECT * FROM cartorder WHERE cart_id = :cart_id AND product_id = :product_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cart_id' => $cartId, 'product_id' => $productId]);
        $existingItem = $stmt->fetch();

        if ($existingItem) {
            // Cập nhật số lượng nếu sản phẩm đã có trong giỏ
            $newQuantity = $existingItem['quantity'] + $quantity;
            $sql = "UPDATE cartorder SET quantity = :quantity WHERE cart_order_id = :cart_order_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['quantity' => $newQuantity, 'cart_order_id' => $existingItem['cart_order_id']]);
        } else {
            // Thêm sản phẩm vào giỏ hàng
            $sql = "INSERT INTO cartorder (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['cart_id' => $cartId, 'product_id' => $productId, 'quantity' => $quantity]);
        }
    }

    // Cập nhật số lượng sản phẩm trong giỏ
    public function updateQuantity($cartOrderId, $quantity)
    {
        $sql = "UPDATE cartorder SET quantity = :quantity WHERE cart_order_id = :cart_order_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['quantity' => $quantity, 'cart_order_id' => $cartOrderId]);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($cartOrderId)
    {
        $sql = "DELETE FROM cartorder WHERE cart_order_id = :cart_order_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cart_order_id' => $cartOrderId]);
    }
    public function getCartItemById($cartOrderId)
    {
        $sql = "
        SELECT co.quantity, p.price
        FROM cartorder co
        JOIN products p ON co.product_id = p.product_id
        WHERE co.cart_order_id = :cart_order_id
    ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cart_order_id' => $cartOrderId]);
        return $stmt->fetch();
    }
    public function getCartTotal($userId)
    {
        $sql = "
        SELECT SUM(co.quantity * p.price) AS total
        FROM cart c
        JOIN cartorder co ON c.cart_id = co.cart_id
        JOIN products p ON co.product_id = p.product_id
        WHERE c.user_id = :user_id
    ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchColumn();
    }
    public function clearCart($userId)
    {
        $sql = "DELETE FROM cartorder WHERE cart_id = (SELECT cart_id FROM cart WHERE user_id = :user_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        // Sau khi xóa cart_order, xóa cart rỗng nếu cần
        $sql = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
    }
    public function getCartByUser($userId)
    {
        return $this->select('*', 'user_id = :user_id', ['user_id' => $userId]);
    }
}
