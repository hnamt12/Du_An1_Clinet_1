
    <?php $sum_total = 0 ?>
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
                    <input type="number" class="quantity-input" name="qty" 
                        data-url="{{ BASE_URL . '/cart.updateQuantity' }}" 
                        data-cart-order-id="{{ $item['cart_order_id'] }}" 
                        id="quantity_{{$item['id']}}" value="{{ $item['quantity'] }}"
                        oninput="updateQuantity({{$item['id']}})"
                        min="1">
                </div>
            </td>
            <td class="product-total-price">
                <span class="product-price-wrapper">
                    <span class="money"><strong>{{ number_format($item['total_price'], 0, ',', '.') }}
                            Vnd</strong></span>
                </span>
            </td>
        </tr>

        <?php 
        $sum_total+=$item['total_price'] ;
        $_SESSION['total'] =  $sum_total;
        ?>
    @endforeach
   


