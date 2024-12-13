<div class="tab-pane show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-xl-3 col-lg-4 col-sm-6 mb--40 mb-md--30">
                <div class="airi-product">
                    <div class="product-inner">
                        <figure class="product-image">
                            <div class="product-image--holder">
                                <a href="products.deltail&id={{ $product['id'] }}">
                                    <img src="{{ BASE_ASSETS_UPLOADS . $product['p_i_image_path'] }}"
                                        alt="Product Image" class="primary-image"  >
                                    <img src="" alt="Product Image" class="secondary-image">
                                </a>
                            </div>
                            {{-- <div class="airi-product-action">
                                                                <div class="product-action">
                                                                    <a class="quickview-btn action-btn"
                                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                                        title="Quick Shop">
                                                                        <span data-bs-toggle="modal"
                                                                            data-bs-target="#productModal">
                                                                            <i class="dl-icon-view"></i>
                                                                        </span>
                                                                    </a>
                                                                    <a class="add_to_cart_btn action-btn"
                                                                        href="cart.html" data-bs-toggle="tooltip"
                                                                        data-bs-placement="left" title="Add to Cart">
                                                                        <i class="dl-icon-cart29"></i>
                                                                    </a>
                                                                    <a class="add_wishlist action-btn"
                                                                        href="wishlist.html" data-bs-toggle="tooltip"
                                                                        data-bs-placement="left" title="Add to Wishlist">
                                                                        <i class="dl-icon-heart4"></i>
                                                                    </a>
                                                                    <a class="add_compare action-btn"
                                                                        href="compare.html" data-bs-toggle="tooltip"
                                                                        data-bs-placement="left" title="Add to Compare">
                                                                        <i class="dl-icon-compare"></i>
                                                                    </a>
                                                                </div>
                                                            </div> --}}
                            <span class="product-badge hot">hot</span>
                        </figure>
                        <div class="product-info">
                            <h3 class="product-title">
                                <a href="products.deltail&id={{ $product['id'] }}">{{ $product['name'] }}</a>
                            </h3>
                            <span class="product-price-wrapper">
                                <span class="money">{{ $product['price'] }}</span>
                            </span>
                        </div>
                        {{-- <div class="btn btn-suucces">
                            <button>theem vao gio hang</button>
                        </div> --}}
                    </div>
                    
                </div>
            </div>
        @endforeach

    </div>
</div>
