<?php
namespace App\Controllers;

use App\Models\User;
use Exception;



class AuthController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function showLoginForm()
    {
        var_dump($_SESSION);
        // try {
        //     if (!empty($_SESSION['user'])) {
        //         // $_SESSION['success'] = false;
        //         // $th= " Vui Lòng Đăng Nhập ";
        //         // $_SESSION['msg'] = $th;
        //         throw new Exception('Yêu cầu phương thức phải là POST');
        //     }   


        //     // header('Location: ' . BASE_URL .'login');

        //     // exit();

        // } catch (\Throwable $th) {
        //     $_SESSION['success'] = false;
        //     $_SESSION['msg'] = $th->getMessage();

        //     header('Location: ' . BASE_URL . 'login');
        //     exit();

        // }
        // session_destroy()   ; 
        return $this->view('auth.login');


    }

    public function login()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if (empty($email) && empty($password)) {
                throw new Exception('Email và Password không được để trống!');
            }elseif(empty($email)){
                throw new Exception('Email  không được để trống!');

            }
            elseif(empty($password)){
                throw new Exception('Password  không được để trống!');

            }

            $user = $this->user->find(
                '*',
                'email = :email AND password = :password',
                [
                    'email' => $email,
                    'password' => $password
                ]
            );

            if (empty($user)) {
                throw new Exception('Thông tin tài khoản không đúng!');
            }

            $_SESSION['user'] = $user;

            header('Location: ' . BASE_URL .'');
            exit();
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL . 'login');
            exit();
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /login');
    }

    private function authenticate($email, $password)
    {
        $db = require __DIR__ . '/../../config/database.php';

        $stmt = $db->prepare("SELECT * FROM Users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
