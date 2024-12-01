@extends('layouts.main')

@section('content')
<div id="content" class="main-content-wrapper">
    <div class="page-content-inner">
        <div class="container">
            <h2>Thanh Toán</h2>
            <form id="checkout-form">
                <!-- Hiển thị danh sách sản phẩm trong giỏ -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th> Hình Anh</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td class="product-thumbnail text-start">  <img src="{{ BASE_ASSETS_UPLOADS . $item['p_i_image_path'] }}"
                                alt="Product Thumnail"></td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }} VND</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VND</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4>                            Tiền Ship : 20.000 VND   </h4>
                <!-- Tổng tiền -->
                <h4>Tổng Cộng: <span id="grand-total">{{ number_format($cartTotal + 20000, 0, ',', '.') }} VND</span></h4>

                <!-- Form thông tin thanh toán -->
                <!-- Hiển thị danh sách địa chỉ có sẵn -->
    <form method="POST" action="/placeOrder">
        <h3>Chọn địa chỉ giao hàng</h3>
        <div class="form-group">
            @foreach ($addresses as $address)
                <div>
                    <input type="radio" name="address_id" id="address_id" value="{{$address['address_id'] }}" data-id="{{$address['address_id'] }}" required>
                    <label>{{ $address['address_line2'] }}, {{ $address['city'] }}, {{ $address['state'] }}</label>
                </div>
            @endforeach
        </div>
        {{-- <form id="add-address-form">
            <h4>Add New Address</h4>
            <input type="text" name="address" placeholder="Address" required>
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="state" placeholder="State" required>
            <input type="text" name="zip_code" placeholder="Zip Code" required>
            <button type="submit">Add Address</button>
        </form> --}}

        <!-- Form thêm địa chỉ mới -->
        {{-- <h3>Hoặc thêm địa chỉ mới</h3>
        <form method="POST" action="/addAddress">
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Thành phố</label>
                <input type="text" name="city" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Bang/Quận</label>
                <input type="text" name="state" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Mã bưu chính</label>
                <input type="text" name="postal_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Quốc gia</label>
                <input type="text" name="country" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm địa chỉ</button>
        </form> --}}
                <div class="form-group">
                    <label for="payment-method">Phương thức thanh toán:</label>
                    <select id="payment-method" name="payment_method" class="form-control" required>
                        <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                        <option value="credit_card">Thẻ tín dụng</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                    </select>
                </div>
                <button type="button" id="place-orders" class="btn btn-primary place-orders" data-url="{{ BASE_URL . '/checkout.placeOrder' }}">Đặt Hàng</button>
            </form>
        </div>
    </div>

</div>
@endsection
<script>
    $(document).ready(function () {
   
});

</script>
