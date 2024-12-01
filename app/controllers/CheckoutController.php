<?php 
namespace App\Controllers;

use App\Models\AddressModel;
use App\Models\CartsModel;
use App\Models\OrderModel;
use App\Models\TransactionModel;

class CheckoutController extends BaseController
{
    public function showCheckout()
    {
        $cartModel = new CartsModel();
        $addressModel = new AddressModel();

        $cartItems = $cartModel->getCartByUser($_SESSION['user_id']);
        $addresses = $addressModel->getAddressesByUser($_SESSION['user_id']);

        return $this->view('checkout', [
            'cartItems' => $cartItems,
            'addresses' => $addresses
        ]);
    }

    public function addAddress()
    {
        $addressModel = new AddressModel();
        $data = [
            'user_id' => $_SESSION['user_id'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'zip_code' => $_POST['zip_code']
        ];

        $addressId = $addressModel->insertAddress($data);
        echo json_encode([
            'status' => 'success',
            'new_address' => array_merge(['id' => $addressId], $data)
        ]);
        exit();
    }

    public function placeOrder()
    {
        $cartModel = new CartsModel();
        $orderModel = new OrderModel();
        $transactionModel = new TransactionModel();

        $addressId = $_POST['address_id'];
        $paymentMethod = $_POST['payment_method'];

        // Tạo đơn hàng
        $orderId = $orderModel->createOrder([
            'user_id' => $_SESSION['user_id'],
            'address_id' => $addressId,
            'status' => 'pending'
        ]);

        // Xử lý giao dịch
        $cartItems = $cartModel->getCartByUser($_SESSION['user_id']);
        $totalAmount = array_sum(array_column($cartItems, 'total_price'));

        $transactionModel->createTransaction([
            'order_id' => $orderId,
            'user_id' => $_SESSION['user_id'],
            'amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'status' => 'completed'
        ]);

        // Xóa giỏ hàng
        $cartModel->clearCart($_SESSION['user_id']);

        // Điều hướng đến trang cảm ơn
        header('Location: /thankyou');
        exit();
    }

    public function thankYou()
    {
        return $this->view('thankyou');
    }
}
