<?php
namespace App\Middlewares;

class AuthMiddleware
{
    // public static function handleAuth($routes, $protectedRoutes) {
    //     session_start(); // Bắt đầu session để kiểm tra trạng thái đăng nhập
    //     $currentRoute = strtok($_SERVER['REQUEST_URI'], '?'); // Lấy route hiện tại

    //     // Nếu route cần bảo vệ và người dùng chưa đăng nhập
    //     if (in_array($currentRoute, $protectedRoutes) && !isset($_SESSION['user'])) {
    //         header('Location: ' .BASE_URL . 'login'); // Điều hướng về trang đăng nhập
    //         exit();
    //     }
    // }

    public static function handle()
    {
        // session_start(); // Khởi tạo session nếu chưa có
        if (!isset($_SESSION['user'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang login
            header('Location: ' . BASE_URL . 'login'); // Điều hướng về trang đăng nhập
            exit();
        }
    }
}
