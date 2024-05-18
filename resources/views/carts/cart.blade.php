@extends('carts.header_cart')

@section('content_cart')
<!-- CONTAINER -->
<div class="app__container payment__cart">
    <div class="grid">
        <div class="grid__row app__contents-cart">
            <div class="grid__column-12">
                <div class="home__product">
                    <div class="grid__row">
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-product_cart">
                            <table class="table__product-cart" id="customers">
                                <tr class="">
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn Giá</th>
                                    <th>Số lượng</th>
                                    <th>Số tiền</th>
                                    <th>Thao tác</th>
                                </tr>
                                @foreach($cart_detail as $cart_product)
                                <tr class="product__cart-item">
                                        <td class="seller__td-img">
                                        <div class="detail__product-info">
                                            <input class="checkbox_cart" type="checkbox" name="{{ $cart_product->id }}" value="{{ $cart_product->id  }}">
                                            <img src="/img/img_auth/iphone-15.webp" alt="" class="seller-img_product">
                                            <a href="" class="information__product-link">
                                                <span class="seller-name_product"> {{ $cart_product->product_cart->product_name }} </span>
                                                <span class="seller-description_product">{{ $cart_product->product_cart->description }}</span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="price__product-cart">{{ $cart_product->product_cart->price }}</span>
                                        <span>đ</span>
                                    </td>
                                    <td>
                                        <div class="quantity__cart">
                                            <div class="sub_quantity">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <div class="number_quantity">{{ $cart_product->quantity }}</div>
                                            <div class="add_quantity">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="total__product-cart">{{ $cart_product->quantity * $cart_product->product_cart->price }}</span>
                                        <span>đ</span>
                                    </td>
                                    <td class="action__product">
                                        <a href="{{ route('cart.delete', $cart_product->id) }}" class="seller__product-delete">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>

                        </div>  
                        <!-- PRODUCT ITEM -->
                        <div class="grid payment__cart-item">
                            <div class="action__cart">
                                <div class="payment__cart-btn">
                                    <button class="btn btn--primary btn__payment" onclick='window.location.href="{{ route("payment.index") }}"' disabled style="opacity: 0.5;">Thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
            </div>
        </div>
    </div>
</div>
@endsection