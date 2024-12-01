@extends('layouts.main')
@section('content')
<div class="container">
    <h2>Cảm ơn bạn đã đặt hàng!</h2>
    <p>Mã đơn hàng: #{{ $orderId }}</p>
    <p>Chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng sớm nhất.</p>
    <a href="/" class="btn btn-primary">Tiếp Tục Mua Sắm</a>
</div>
@endsection
