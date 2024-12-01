@extends('layouts.main')
@section('content')
    <div id="content" class="main-content-wrapper">
        <div class="page-content-inner">
            <div class="container">
                <div class="row pt--80 pb--80 pt-md--45 pt-sm--25 pb-md--60 pb-sm--40">
                    <div class="col-lg-8 mb-md--30">
                        <form class="cart-form" action="#">
                            <div class="row g-0">
                                <div class="col-12">
                                    <div class="table-content table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th class="text-start">Product</th>
                                                    <th>price</th>
                                                    <th>quantity</th>
                                                    <th>total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="order">
                                                <?php $sum_total = 0; ?>
                                                @foreach ($cartItems as $item)
                                                    <tr>
                                                        <td class="text-start">
                                                            <button class=" remove-item"
                                                                data-cart-order-id="{{ $item['cart_order_id'] }}"
                                                                data-url="{{ BASE_URL . '/cart.remove' }}"><i
                                                                    class="dl-icon-close"> </i></button>

                                                        </td>
                                                        <td class="product-thumbnail text-start">
                                                            <img src="{{ BASE_ASSETS_UPLOADS . $item['p_i_image_path'] }}"
                                                                alt="Product Thumnail">
                                                        </td>
                                                        <td class="product-name text-start wide-column">
                                                            <h3>
                                                                <a href="product-details.html">{{ $item['name'] }}</a>
                                                            </h3>
                                                        </td>
                                                        <td class="product-price">
                                                            <span class="product-price-wrapper">
                                                                <span
                                                                    class="money">{{ number_format($item['price'], 0, ',', '.') }}
                                                                    Vnd</span>
                                                            </span>
                                                        </td>
                                                        <td class="product-quantity">
                                                            <div class="quantity">
                                                                <input type="number" name="qty" class="quantity-input"
                                                                    data-url="{{ BASE_URL . '/cart.updateQuantity' }}"
                                                                    data-cart-order-id="{{ $item['cart_order_id'] }}"
                                                                    id="quantity_{{ $item['cart_order_id'] }}"
                                                                    value="{{ $item['quantity'] }}" min="1">

                                                            </div>
                                                        </td>
                                                        {{-- <td class="product-total-price" id="total-price-{{ $item['cart_order_id'] }}">
                                                            <span class="product-price-wrapper">
                                                                <span class="money"><strong>{{ number_format($item['total_price'], 0, ',', '.') }}
                                                                        Vnd</strong></span>
                                                            </span>
                                                        </td> --}}
                                                        <td class="product-total-price money"
                                                            id="total-price-{{ $item['cart_order_id'] }}">
                                                            <span class="money"><strong>{{ number_format($item['total_price'], 0, ',', '.') }}
                                                                    VND</strong></span>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $sum_total += $item['total_price'];
                                                    $_SESSION['total'] = $sum_total;
                                                    ?>
                                                @endforeach



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 border-top pt--20 mt--20">
                                <div class="col-sm-6">
                                    <div class="coupon">
                                        <input type="text" id="coupon" name="coupon" class="cart-form__input"
                                            placeholder="Coupon Code">
                                        <button type="submit" class="cart-form__btn">Apply Coupon</button>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <button type="submit" class="cart-form__btn">Clear Cart</button>
                                    <button type="submit" class="cart-form__btn">Update Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="col-lg-4">
                        <div class="cart-collaterals">
                            <div class="cart-totals">
                                <h5 class="mb--15">Cart totals</h5>
                                <div class="table-content table-responsive">
                                    <table class="table order-table">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                {{-- <td><strong id="cart-total">{{ number_format( $sum_total, 0, ',', '.') }}
                                                    Vnd</strong></td> --}}
                                                <td id="cart-total">
                                                    <strong>{{ number_format($sum_total, 0, ',', '.') }} VND</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>
                                                    <span>Flat rate: $20.00</span>
                                                    <div class="shipping-calculator-wrap">
                                                        <a href="#shipping_calculator" class="expand-btn">Calculate
                                                            Shipping</a>
                                                        <form id="shipping_calculator"
                                                            class="form shipping-calculator-form hide-in-default">
                                                            <div class="form__group mb--10">
                                                                @include('layouts.compoments.local_contry');
                                                            </div>
                                                            <div class="form__group mb--10">
                                                                @include('layouts.compoments.loacl_district');
                                                            </div>

                                                            <div class="form__group mb--10">
                                                                <input type="text" name="calc_shipping_city"
                                                                    id="calc_shipping_city" placeholder="Town / City">
                                                            </div>

                                                            <div class="form__group mb--10">
                                                                <input type="text" name="calc_shipping_zip"
                                                                    id="calc_shipping_zip" placeholder="Postcode / Zip">
                                                            </div>

                                                            <div class="form__group">
                                                                <input type="submit" value="Update Totals">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td>
                                                    <span class="product-price-wrapper">
                                                        <span class="money">$226.00</span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <a href="{{route('checkout.index')}}" class="btn btn-fullwidth btn-style-1">
                                Proceed To Checkout hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        // Gửi AJAX để cập nhật số lượng sản phẩm
        function updateQuantity(cartOrderId, quantity, url) {
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    cart_order_id: cartOrderId,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.status = 'success') {
                        // Cập nhật giá tiền của sản phẩm
                        $('#total-price-' + cartOrderId).html(response.new_total_price + ' VND');
                        // Cập nhật tổng tiền của giỏ hàng
                        $('#cart-total').html(response.cart_total + ' VND');
                    } else {
                        alert(response.message || 'Có lỗi xảy ra khi cập nhật.');
                    }
                },
                error: function() {
                    alert('Không thể kết nối đến server.');
                }
            });
        }

        // Thêm sản phẩm vào giỏ hàng
        $(document).on('click', '.add-to-cart', function() {
            var productId = $(this).data('product-id');
            var quantity = 1; // Hoặc lấy từ input số lượng nếu có

            $.ajax({
                url: '/cart.add',
                method: 'POST',
                data: {
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Sản phẩm đã được thêm vào giỏ hàng!');
                    } else {
                        alert(response.message || 'Không thể thêm sản phẩm.');
                    }
                },
                error: function() {
                    alert('Không thể kết nối đến server.');
                }
            });
        });

        // Khởi tạo sự kiện tăng/giảm số lượng
        customQuantity();
    });
</script>
