@extends('layouts.main')
@section('content')
    <?php
    if (isset($_SESSION['success'])) {
        $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';
    
        echo "<div class='alert $class'> {$_SESSION['msg']} </div>";
    
        unset($_SESSION['success']);
        unset($_SESSION['msg']);
    }
    ?>
    <div class="container">
        <div class="container2">
            <div class="login-card">
                <h3 class="text-center mb-4">Đăng Nhập</h3>

                <!-- Form Login -->
                <form action="login.action" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" 
                            >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" 
                            >
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-custom">Đăng Nhập</button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="#">Quên mật khẩu?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;


        }

        .container2 {
            /* margin: 30px ;  */
            padding-top: 30px;
            /* padding-bottom: 30px ;   */
            max-width: 500px;
            width: 100%;
            /* Đảm bảo container không vượt quá 500px */
            justify-content: center;

        }

        .login-card {
            justify-content: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
@endsection