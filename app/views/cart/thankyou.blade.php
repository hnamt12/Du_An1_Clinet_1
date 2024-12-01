@extends('layouts.main')

@section('content')
    <h1>Thank You!</h1>
    <p>Your order has been placed successfully!</p>
    <h3>Thông tin giao hàng</h3>
        <ul>
            <li><strong>Họ tên:</strong> {{ $address['user_name'] }}</li>
            <li><strong>Địa chỉ:</strong> {{ $address['address_line2'] }}, {{ $address['city'] }}, {{ $address['state'] }}</li>
            <li><strong>Mã bưu điện:</strong> {{ $address['postal_code'] }}</li>
            <li><strong>Quốc gia:</strong> {{ $address['country'] }}</li>
        </ul>

        <h3>Thông tin đơn hàng</h3>
        <ul>
            <li><strong>Mã đơn hàng:</strong> {{ $order['order_id'] }}</li>
            <li><strong>Ngày đặt:</strong> {{ $order['created_at'] }}</li>
            <li><strong>Trạng thái:</strong> {{ $order['status'] }}</li>
        </ul>

        <h3>Danh sách sản phẩm</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $item)
                    <tr>
                        <td>{{ $item['product_name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} VND</td>
                        <td>{{ number_format($item['total_price'], 0, ',', '.') }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Tổng cộng</h3>
        <p><strong>{{ number_format(array_sum(array_column($orderItems, 'total_price')), 0, ',', '.') }} VND</strong></p>

@endsection
