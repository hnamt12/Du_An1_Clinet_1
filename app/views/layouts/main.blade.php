<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from htmldemo.net/airi/airi/index-05.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 10:48:12 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <!-- Favicons -->

    <!-- Title -->
    <title>Airi - Clean, Minimal eCommerce Bootstrap 5 Template</title>

    <!-- ************************* CSS Files ************************* -->
    @include('layouts.partials.css')

    <!-- modernizr JS
    ============================================ -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="ai-preloader active">
        <div class="ai-preloader-inner h-100 d-flex align-items-center justify-content-center">
            <div class="ai-child ai-bounce1"></div>
            <div class="ai-child ai-bounce2"></div>
            <div class="ai-child ai-bounce3"></div>
        </div>
    </div>

    <!-- Main Wrapper Start -->
    <div class="wrapper">
        <!-- Header Area Start -->
        @include('layouts.compoments.header_area_start')

        <!-- Header Area End -->

        <!-- Mobile Header area Start -->
        @include('layouts.compoments.mobile_header')

        <!-- Mobile Header area End -->

        <!-- Main Content Wrapper Start -->
        @yield('content')
       
        <!-- Main Content Wrapper Start -->

        <!-- Footer Start -->
        @include('layouts.partials.footer_main')

        <!-- Footer End -->

        <!-- Search from Start -->
        @include('layouts.partials.search_form_main')

        <!-- Search from End -->

        <!-- Side Navigation Start -->
        @include('layouts.partials.side_navigation')
        <!-- Side Navigation End -->

        <!-- Mini Cart Start -->
        @include('layouts.products.products_cart.mini_cart')
        <!-- Mini Cart End -->

        <!-- Global Overlay Start -->
        <div class="ai-global-overlay"></div>
        <!-- Global Overlay End -->

        <!-- Modal Start -->
        @include('layouts.partials.model_start')

        <!-- Modal End -->

    </div>
    <!-- Main Wrapper End -->


    <!-- ************************* JS Files ************************* -->

    <!-- jQuery JS -->



</body>
@include('layouts.partials.js')


<!-- Mirrored from htmldemo.net/airi/airi/index-05.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 10:49:47 GMT -->

</html>
