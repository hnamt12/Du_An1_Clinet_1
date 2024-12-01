@extends('layouts.main')
@section('content')
    <div id="content" class="main-content-wrapper">
        <div class="page-content-inner enable-full-width">
            <div class="container-fluid">
                <div class="row pt--40">
                    <div class="col-md-6 product-main-image">
                        <div class="product-image">
                            <div class="product-gallery vertical-slide-nav">
                                <div class="product-gallery__thumb">
                                    <div class="product-gallery__thumb--image">
                                        <div class="airi-element-carousel nav-slider slick-vertical"
                                            data-slick-options='{
                                        "slidesToShow": 3,
                                        "slidesToScroll": 1,
                                        "vertical": true,
                                        "swipe": true,
                                        "verticalSwiping": true,
                                        "infinite": true,
                                        "focusOnSelect": true,
                                        "asNavFor": ".main-slider",
                                        "arrows": true, 
                                        "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-up" },
                                        "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-down" }
                                    }'
                                            data-slick-responsive='[
                                        {
                                            "breakpoint":992, 
                                            "settings": {
                                                "slidesToShow": 4,
                                                "vertical": false,
                                                "verticalSwiping": false
                                            } 
                                        },
                                        {
                                            "breakpoint":575, 
                                            "settings": {
                                                "slidesToShow": 3,
                                                "vertical": false,
                                                "verticalSwiping": false
                                            } 
                                        },
                                        {
                                            "breakpoint":480, 
                                            "settings": {
                                                "slidesToShow": 2,
                                                "vertical": false,
                                                "verticalSwiping": false
                                            } 
                                        }
                                    ]'>
                                            <figure class="product-gallery__thumb--single">
                                                <img src="{{ BASE_ASSETS_UPLOADS . $product['p_i_image_path'] }}" alt="Products">
                                            </figure>
                                            <figure class="product-gallery__thumb--single">
                                                <img src="{{ BASE_ASSETS_UPLOADS . $product['p_i_image_path'] }}" alt="Products">
                                            </figure>
                                            <figure class="product-gallery__thumb--single">
                                                <img src="{{ BASE_ASSETS_UPLOADS . $product['p_i_image_path'] }}" alt="Products">
                                            </figure>
                                            <figure class="product-gallery__thumb--single">
                                                <img src="{{ BASE_ASSETS_UPLOADS . $product['p_i_image_path'] }}" alt="Products">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-gallery__large-image">
                                    <div class="gallery-with-thumbs">
                                        <div class="product-gallery__wrapper">
                                            <div class="airi-element-carousel main-slider product-gallery__full-image image-popup"
                                                data-slick-options='{
                                            "slidesToShow": 1,
                                            "slidesToScroll": 1,
                                            "infinite": true,
                                            "arrows": false, 
                                            "asNavFor": ".nav-slider"
                                        }'>
                                                {{-- <figure class="product-gallery__image zomm"> --}}

                                                <figure class="product-gallery__image ">
                                                    <img src="{{ BASE_ASSETS_UPLOADS . $product['p_i_image_path'] }}" alt="Product">
                                                </figure>
                                                <figure class="product-gallery__image ">
                                                    <img src="{{ BASE_ASSETS_UPLOADS . $product['p_i_image_path'] }}" alt="Product">
                                                </figure>
                                                <figure class="product-gallery__image ">
                                                    <img src="{{ BASE_ASSETS_UPLOADS . $product['p_i_image_path'] }}" alt="Product">
                                                </figure>
                                                <figure class="product-gallery__image ">
                                                    <img src="{{ BASE_ASSETS_UPLOADS . $product['p_i_image_path'] }}" alt="Product">
                                                </figure>
                                            </div>
                                            <div class="product-gallery__actions">
                                                <button class="action-btn btn-zoom-popup"><i
                                                        class="dl-icon-zoom-in"></i></button>
                                                {{-- <a href="https://www.youtube.com/watch?v=Rp19QD2XIGM"
                                                    class="action-btn video-popup"><i class="dl-icon-format-video"></i></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="product-badge new">New</span>
                        </div>
                    </div>
                    <div class="col-md-6 product-main-details mt--40 mt-md--10 mt-sm--30">
                        <div class="product-summary">
                            <div class="product-rating float-left">
                                <span>
                                    <i class="dl-icon-star rated"></i>
                                    <i class="dl-icon-star rated"></i>
                                    <i class="dl-icon-star rated"></i>
                                    <i class="dl-icon-star rated"></i>
                                    <i class="dl-icon-star rated"></i>
                                </span>
                                <a href="#" class="review-link">(1 customer review)</a>
                            </div>
                            <div class="product-navigation">
                                {{-- <a href="#" class="prev"><i class="dl-icon-left"></i></a>
                                <a href="#" class="next"><i class="dl-icon-right"></i></a> --}}
                            </div>
                            <div class="clearfix"></div>
                            <h3 class="product-title">{{$product['name']}}</h3>
                            <span class="product-stock in-stock float-right">
                                <i class="dl-icon-check-circle1"></i>
                                in stock
                            </span>
                            <div class="product-price-wrapper mb--40 mb-md--10">
                                <span class="money">{{$product['price']}}</span>
                                <span class="old-price">
                                    <span class="money">$60.00</span>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                            <p class="product-short-description mb--45 mb-sm--20">Donec accumsan auctor iaculis. Sed
                                suscipit arcu ligula, at egestas magna molestie a. Proin ac ex maximus, ultrices justo eget,
                                sodales orci. Aliquam egestas libero ac turpis pharetra, in vehicula lacus scelerisque.
                                Vestibulum ut sem laoreet, feugiat tellus at, hendrerit arcu.</p>
                            <form action="#" class="variation-form mb--35">
                                <div class="product-color-variations mb--20">
                                    <p class="swatch-label">Color: <strong class="swatch-label"></strong></p>
                                    <div class="product-color-swatch variation-wrapper">
                                        <div class="swatch-wrapper">
                                            <a class="product-color-swatch-btn variation-btn blue" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Blue">
                                                <span class="product-color-swatch-label">Blue</span>
                                            </a>
                                        </div>
                                        <div class="swatch-wrapper">
                                            <a class="product-color-swatch-btn variation-btn green" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Green">
                                                <span class="product-color-swatch-label">Green</span>
                                            </a>
                                        </div>
                                        <div class="swatch-wrapper">
                                            <a class="product-color-swatch-btn variation-btn pink" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Pink">
                                                <span class="product-color-swatch-label">Pink</span>
                                            </a>
                                        </div>
                                        <div class="swatch-wrapper">
                                            <a class="product-color-swatch-btn variation-btn red" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="Red">
                                                <span class="product-color-swatch-label">Red</span>
                                            </a>
                                        </div>
                                        <div class="swatch-wrapper">
                                            <a class="product-color-swatch-btn variation-btn white"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="White">
                                                <span class="product-color-swatch-label">white</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-size-variations">
                                    <p class="swatch-label">Size: <strong class="swatch-label"></strong></p>
                                    <div class="product-size-swatch variation-wrapper">
                                        <div class="swatch-wrapper">
                                            <a class="product-size-swatch-btn variation-btn" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="L">
                                                <span class="product-size-swatch-label">L</span>
                                            </a>
                                        </div>
                                        <div class="swatch-wrapper">
                                            <a class="product-size-swatch-btn variation-btn" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="M">
                                                <span class="product-size-swatch-label">M</span>
                                            </a>
                                        </div>
                                        <div class="swatch-wrapper">
                                            <a class="product-size-swatch-btn variation-btn" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="S">
                                                <span class="product-size-swatch-label">S</span>
                                            </a>
                                        </div>
                                        <div class="swatch-wrapper">
                                            <a class="product-size-swatch-btn variation-btn" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="XL">
                                                <span class="product-size-swatch-label">XL</span>
                                            </a>
                                        </div>
                                        <div class="swatch-wrapper">
                                            <a class="product-size-swatch-btn variation-btn" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="XXL">
                                                <span class="product-size-swatch-label">XXL</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="reset_variations">Clear</a>
                            </form>

                            <form action="#" class="form--action mb--30 mb-sm--20">
                                <div class="product-action flex-row align-items-center">
                                    <div class="quantity">
                                        <input type="number" class="quantity-input" name="qty" id="qty"
                                            value="1" min="1">
                                    </div>
                                    <button type="button" class="btn btn-style-1 btn-large add-to-cart" data-url="{{ BASE_URL . '/cart.add' }}" data-product-id="{{ $product['id'] }}">
                                        Add To Cart
                                    </button>
                                    <a href="wishlist.html"><i class="dl-icon-heart2"></i></a>
                                    <a href="compare.html"><i class="dl-icon-compare2"></i></a>
                                </div>
                            </form>
                            <div class="product-extra mb--40 mb-sm--20">
                                <a href="#" class="font-size-12"><i class="fa fa-map-marker"></i>Find store near
                                    you</a>
                                <a href="#" class="font-size-12"><i class="fa fa-exchange"></i>Delivery and
                                    return</a>
                            </div>
                            <div class="product-summary-footer d-flex justify-content-between flex-sm-row flex-column">
                                <div class="product-meta">
                                    <span class="sku_wrapper font-size-12">SKU: <span class="sku">REF.
                                            LA-887</span></span>
                                    <span class="posted_in font-size-12">Categories:
                                        <a href="shop-sidebar.html">Fashions</a>
                                    </span>
                                    <span class="posted_in font-size-12">Tags:
                                        <a href="shop-sidebar.html">dress,</a>
                                        <a href="shop-sidebar.html">fashions,</a>
                                        <a href="shop-sidebar.html">women</a>
                                    </span>
                                </div>
                                <div class="product-share-box">
                                    <span class="font-size-12">Share With</span>
                                    <!-- Social Icons Start Here -->
                                    <ul class="social social-small">
                                        <li class="social__item">
                                            <a href="https://facebook.com/" class="social__link">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="social__item">
                                            <a href="https://twitter.com/" class="social__link">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="social__item">
                                            <a href="https://plus.google.com/" class="social__link">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="social__item">
                                            <a href="https://plus.google.com/" class="social__link">
                                                <i class="fa fa-pinterest-p"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Social Icons End Here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.products.product_detail.compoment.review') ;

                @include('layouts.products.product_detail.compoment.sale') ;
                @include('layouts.products.product_detail.compoment.related') ;

            </div>
        </div>
    </div>
@endsection
