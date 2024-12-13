<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AddressModel;
use App\Models\BaseModel;
use App\Models\CartsModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\TransactionModel;

// var_dump($_POST) ; 

class CartsController extends BaseController
{
    protected $cartModel;
    protected $orderModel;
    protected $transactionModel;

    protected $addressModel;
    protected $orderItemModel ; 


    public function __construct()
    {
        $this->cartModel = new CartsModel();
        $this->orderModel = new OrderModel();
        $this->transactionModel = new TransactionModel();
        $this->addressModel = new AddressModel();
        $this->orderItemModel = new OrderItemModel();
    }

    public function index()
    {
        // $carts = $this->cart
        // var_dump($_SESSION);
        $cartItems = $this->cartModel->getCartItems($_SESSION['user']['user_id']);
        // debug($cartItems); 
        // var_dump($cartItems);
        // die ; 
        return $this->view('cart.index', compact('cartItems'));
    }

    public function update()
    {
        // $carts = $this->cart
        // var_dump($_SESSION);
        $cartItems = $this->cartModel->getCartItems($_SESSION['user']['user_id']);
        // debug($cartItems); 
        // die ; 
        return $this->view('cart.updateQuantity', compact('cartItems'));
    }
    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['product_id'];
            $userId = $_SESSION['user']['user_id'];  // ID người dùng đã đăng nhập
            $quantity = $_POST['quantity'];

            $this->cartModel->addToCart($userId, $productId, $quantity);
            $cart = [
                'id' => $productId,
                'userId' => $userId,
                'quantity' => $quantity,
            ];
            $_SESSION['cart'][] = $cart;


            echo json_encode(['status' => 'success']);
            exit();
        }
    }


    public function updateQuantity()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cartOrderId = $_POST['cart_order_id'];
            $quantity = $_POST['quantity'];

            // Kiểm tra số lượng hợp lệ
            // if ($quantity < 1) {
            //     echo json_encode(['status' => 'error', 'message' => 'Số lượng không hợp lệ.']);
            //     exit();
            // }

            // Cập nhật số lượng
            $this->cartModel->updateQuantity($cartOrderId, $quantity);


            // Lấy thông tin sản phẩm và tính tổng tiền mới
            $cartItem = $this->cartModel->getCartItemById($cartOrderId);
            $newTotalPrice = $cartItem['quantity'] * $cartItem['price'];
            $cartTotal = $this->cartModel->getCartTotal($_SESSION['user']['user_id']);

            // Trả về JSON
            echo json_encode([
                'status' => 'success',
                'new_total_price' => number_format($newTotalPrice, 0, ',', '.'),
                'cart_total' => number_format($cartTotal, 0, ',', '.')
            ]);
            exit();
        }
    }





    public function removeFromCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cartOrderId = $_POST['cart_order_id'];

            $this->cartModel->removeFromCart($cartOrderId);

            echo json_encode(['status' => 'success']);
            header('Location: ' . BASE_URL . 'cart.index');

        }
    }

    public function indexcheckout()
    {
        // $carts = $this->cart
        // var_dump($_SESSION);
        // $cartItems = $this->cartModel->getCartItems($_SESSION['user']['user_id']);
        // debug($cartItems); 
        // var_dump($cartItems);
        // die ; 
        $userId = $_SESSION['user']['user_id'];
        

        $cartItems = $this->cartModel->getCartItems($userId);
        var_dump( $cartItems);
        $cartTotal = $this->cartModel->getCartTotal($userId);
        $addresses = $this->addressModel->getAddressesByUser($userId);


        return $this->view('cart.checkout', compact('cartItems', 'cartTotal', 'addresses'));
    }
    public function placeOrder()
    {
        // Nhận dữ liệu từ AJAX
        $addressId = $_POST['address_id'];
        $paymentMethod = $_POST['payment_method'];

        // Khởi tạo model
        // $addressModel = new AddressModel();
        // $orderModel = new OrderModel();
        // $transactionModel = new TransactionModel();
        // $cartModel = new CartModel();
        $userId = $_SESSION['user']['user_id'];

        // Kiểm tra địa chỉ hợp lệ
        $address = $this->addressModel->find('*', 'address_id = :address_id AND user_id = :user_id', [
            'address_id' => $addressId,
            'user_id' => $userId
        ]);

        if (!$address) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Địa chỉ không hợp lệ.'
            ]);
            exit();
        }

        // Lấy thông tin giỏ hàng
        $cartItems = $this->cartModel->getCartItems($userId);
        if (empty($cartItems)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Giỏ hàng trống.'
            ]);
            exit();
        }
       

        // Tính tổng số tiền
        $totalAmount = array_sum(array_column($cartItems, 'total_price'));
        

        // Tạo đơn hàng
        $orderId = $this->orderModel->createOrder([
            'user_id' => $userId,
            'address_id' => $addressId,
            'total_amount' => $totalAmount ,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        // Thêm sản phẩm vào bảng order_items
        foreach ($cartItems as $item) {
           $orderdel= $this->orderItemModel->insertOrderItem([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'], // Giá từng sản phẩm
                'total_price' => $item['total_price']
            ]);
        }
        // debug($orderdel);
        // die;


        // Thêm giao dịch
        $this->transactionModel->createTransaction([
            'order_id' => $orderId,
            'user_id' => $userId,
            'amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'status' => 'completed',
            'created_at' => date('Y-m-d H:i:s')
        ]);


        // Xóa giỏ hàng
        $this->cartModel->clearCart($userId);
        //    debug($deleCart);
        //    die ;
        // Trả về kết quả
        echo json_encode([
            'status' => 'success',
            'order_id' => $orderId
        ]);
        exit();
    }
    public function addAddress()
    {
        $addressModel = new AddressModel();
        

        $newAddress = [
            'user_id' => $userId,
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'zip_code' => $_POST['zip_code']
        ];
        $addressModel->insert($newAddress);
        header('Location: /checkout');
        exit;
    }
    public function thankYou()
    {
        $orderId = $_GET['order_id']; // Lấy order_id từ URL
        $userId = $_SESSION['user']['user_id'];
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $addressModel = new AddressModel();

        // Lấy thông tin đơn hàng
        $order = $orderModel->find('*', 'order_id = :order_id AND user_id = :user_id', [
            'order_id' => $orderId,
            'user_id' => $userId 
        ]);

        if (!$order) {
            die('Không tìm thấy đơn hàng.');
        }

        // Lấy danh sách sản phẩm trong đơn hàng
        $orderItems = $orderItemModel->select('*', 'order_id = :order_id', [
            'order_id' => $orderId
        ]);

        // Lấy địa chỉ giao hàng
        $address = $addressModel->find('*', 'address_id = :address_id', [
            'address_id' => $order['address_id']
        ]);

        // Hiển thị thông tin đơn hàng
        return $this->view('cart.thankyou', [
            'order' => $order,
            'orderItems' => $orderItems,
            'address' => $address
        ]);
    
    }


}
