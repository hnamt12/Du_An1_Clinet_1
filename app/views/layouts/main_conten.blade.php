@extends('layouts.main')


@section('content')
    <div id="content" class="main-content-wrapper">


        @include('layouts.partials.slide_show_main')



        <!-- Banner Area Start Here -->

        @include('layouts.partials.banner_main')
        <!-- Banner Area End Here -->

        <!-- Product tab area Start Here -->
        <section class="product-tab-area ptb--40 ptb-md--30">
            <div class="container-fluid">
                <div class="row mb--40 mb-md--30">
                    <div class="col-12 text-center">
                        <h2 class="heading-secondary">New Arrival</h2>
                        <hr class="separator center mt--25 mt-md--15">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-tab tab-style-3">
                            {{-- Thanh nav điều hướng danh mục --}}
                            @include('layouts.products.products_categorye.nav_product_category')

                            <div class="tab-content product-tab__content fadeInUp" id="product-tabContent">
                                @include('layouts.products.products_categorye.nav_all_products')

                                @include('layouts.products.products_categorye.nav_all_1_product')


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="shop-sidebar.html" class="heading-button">View All</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product tab area End Here -->

        <!-- Instagram Feed area Start Here -->
        @include('layouts.compoments.Instagram_feed')



        <!-- Instagram Feed area End Here -->

        <!-- Method area Start Here -->
        @include('layouts.compoments.methoud_area')
        <!-- Method area End Here -->

    </div>
@endsection
