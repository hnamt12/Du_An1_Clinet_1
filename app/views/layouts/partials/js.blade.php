<script src="<?= BASE_URL ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/vendor/jquery.min.js"></script>

<!-- Bootstrap and Popper Bundle JS -->
<script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>

<!-- All Plugins Js -->
<script src="<?= BASE_URL ?>assets/js/plugins.js"></script>

<!-- Ajax Mail Js -->
<script src="<?= BASE_URL ?>assets/js/ajax-mail.js"></script>

<!-- Main JS -->
<script src="<?= BASE_URL ?>assets/js/main.js"></script>


<!-- REVOLUTION JS FILES -->
<script src="<?= BASE_URL ?>assets/js/revoulation/jquery.themepunch.tools.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/revoulation/jquery.themepunch.revolution.min.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="<?= BASE_URL ?>assets/js/revoulation/extensions/revolution.extension.actions.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/revoulation/extensions/revolution.extension.carousel.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/revoulation/extensions/revolution.extension.kenburn.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/revoulation/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/revoulation/extensions/revolution.extension.migration.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/revoulation/extensions/revolution.extension.navigation.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/revoulation/extensions/revolution.extension.parallax.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/revoulation/extensions/revolution.extension.slideanims.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/revoulation/extensions/revolution.extension.video.min.js"></script>

<!-- REVOLUTION ACTIVE JS FILES -->
<script src="<?= BASE_URL ?>assets/js/revoulation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Thêm sản phẩm vào giỏ hàng
        $('.add-to-cart').on('click', function() {
            var productId = $(this).data('product-id'); // Lấy ID sản phẩm từ data-product-id
            var quantity = $('#qty').val(); // Lấy số lượng từ input
            var url = $(this).data('url'); // Lấy URL từ data-url
            // alert(quantity)
            // Gửi yêu cầu AJAX tới server
            $.ajax({
                url: url, // Route xử lý thêm sản phẩm vào giỏ
                method: 'POST', // Phương thức gửi dữ liệu
                data: {
                    product_id: productId,
                    // ID sản phẩm

                    quantity: quantity // Số lượng sản phẩm
                },
                success: function(response) {
                    if (response.status = 'success') {
                        alert('Sản phẩm đã được thêm vào giỏ hàng!');
                    } else {
                        alert(
                            'Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại.'
                            );
                    }
                },
                error: function() {
                    alert('Không thể kết nối đến server. Vui lòng thử lại sau.');
                }
            });
            // console.log(product_id) ;

        });
        $(".qtybutton").on("click", function() {
            var $button = $(this);
            var input = $button.parent().find("input");
            var oldValue = parseFloat(input.val());
            var newVal;
            var url = input.data('url');
            console.log("$ ~ url", url);
            // Lấy URL từ data-url
            var quantity = $('#qty').val(); // Lấy số lượng từ input
            if ($button.hasClass("inc")) {
                newVal = oldValue + 0;
            } else {
                newVal = oldValue > 1 ? oldValue - 0 : 1;
            }

            input.val(newVal);
            var quantity = newVal;

            // Gửi AJAX để cập nhật số lượng
            var cartOrderId = input.data("cart-order-id");
            // alert(123);
            // var cartOrderId = $(this).data('cart-order-id');
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    cart_order_id: cartOrderId,
                    quantity: quantity
                },
                success: function(response) {
                    // Chuyển đổi JSON trả về nếu chưa được parse
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
                    if (response.status = 'success') {
                        console.log("$ ~ response", response.new_total_price)
                        // Cập nhật giá tiền của sản phẩm

                        $('#total-price-' + cartOrderId).html(
                            '<span><strong>' + response.new_total_price + ' VND' +
                            '</strong></span>'
                        );
                        // Cập nhật tổng tiền của giỏ hàng
                        $('#cart-total').html(
                            '<span><strong>' + response.cart_total + ' VND' +
                            '</strong></span>'
                        );
                    } else {
                        alert(response.message || 'Có lỗi xảy ra khi cập nhật.');
                    }
                },
                error: function() {
                    alert('Không thể kết nối đến server.');
                }
            });

            console.log("cartOrderId ", cartOrderId)



        })
        // Xóa sản phẩm khỏi giỏ hàng
        $('.remove-item').on('click', function() {
            var cartOrderId = $(this).data('cart-order-id');
            var url = $(this).data('url'); // Lấy URL từ data-url


            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    cart_order_id: cartOrderId
                },
                success: function(response) {
                    if (response.status = 'success') {
                        $('#cart-item-' + cartOrderId).remove();

                    }
                }
            });
        });

        // checkout
        $('.place-orders').on('click', function() {
            // var productId = $(this).data('product-id'); // Lấy ID sản phẩm từ data-product-id

            const address_id = $('input[name="address_id"]:checked').val();
            // console.log("address_id", address_id)
            const paymentMethod = $('#payment-method').val();
            // console.log("paymentMethod", paymentMethod)
            var url = $(this).data('url'); // Lấy URL từ data-url
            // console.log("url ", url )



            if (!address_id || !paymentMethod) {
                alert('Vui lòng nhập đầy đủ thông tin.');
                return;
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    address_id: address_id,
                    payment_method: paymentMethod
                },
                success: function(response) {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
                    if (response.status = 'success') {
                        // console.log("$ ~ response", response.order_id )

                       
                        alert('Đặt hàng thành công!');
                        window.location.href = 'http://localhost/Du_an1_Wd19306_Clinet_test/thankyou?order_id='+ response.order_id;
                    } else {
                        alert(response.message || 'Có lỗi xảy ra.');
                    }
                },
                error: function() {
                    alert('Không thể kết nối đến server.');
                }
            });
        });

        $('#add-address-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '/add-address',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        $('#addresses').append(`
                        <div>
                            <input type="radio" name="address_id" value="${response.new_address.id}">
                            ${response.new_address.address}, ${response.new_address.city}, ${response.new_address.state}
                        </div>
                    `);
                        alert('Address added successfully!');
                    }
                }
            });
        });

        // $('#place-order-btn').on('click', function () {
        //     const addressId = $('input[name="address_id"]:checked').val();
        //     const paymentMethod = $('#payment-method').val();

        //     if (!addressId) {
        //         alert('Please select a shipping address.');
        //         return;
        //     }

        //     $.ajax({
        //         url: '/place-order',
        //         method: 'POST',
        //         data: {
        //             address_id: addressId,
        //             payment_method: paymentMethod
        //         },
        //         success: function () {
        //             window.location.href = '/thankyou';
        //         }
        //     });
        // });


    });
</script>
