@extends('carts.header_cart')

@section('content_cart')
<!-- CONTAINER -->
<div class="app__container payment__cart">
    <div class="grid">
        <form class="grid__row app__contents-cart" action="{{ route('orders.store') }}" method="POST">
            <div class="grid__column-12">
                <div class="home-filter_payment">
                    <div class="title__home-filter">
                        <i class="fa-solid fa-location-dot"></i>
                        <div class="title__home-page">Địa chỉ</div>
                    </div>
                    <div class="filter_payment-content">
                        <div class="payment-content-info">
                            <div class="content__info-name">Nguyễn Minh Hiệp</div>
                            <div class="content__info-phone">0834983286</div>
                        </div>
                        <div class="payment-content-address">Bình Thành, Đức Huệ, Long An</div>
                    </div>
                </div>
                <div class="home__product">
                    <div class="grid__row">
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-product_cart">
                            @csrf
                            <table class="table__product-payment" id="customers__payment">
                                <tr class="">
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                @foreach($cart_detail as $cart_product)
                                <tr class="product__cart-item">
                                    <td class="seller__td-img">
                                        <div class="detail__product-info">
                                            <img src="/img/img_auth/iphone-15.webp" alt="" class="seller-img_product payment-img_product">
                                            <a href="" class="information__product-link">
                                                <span class="seller-name_product payment-name_product"> {{ $cart_product->product_cart->product_name }} </span>
                                                <span class="seller-description_product payment-description_product">{{ $cart_product->product_cart->description }}</span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="price__product-cart payment-price_product"> {{ $cart_product->product_cart->price }}</span>
                                        <span>đ</span>
                                    </td>
                                    <td>
                                        <div class="quantity__cart">
                                            <div class="number_quantity payment-number_quantity">{{ $cart_product->quantity }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="total__product-cart payment-total">{{ $cart_product->quantity * $cart_product->product_cart->price }}</span>
                                        <span>đ</span>
                                    </td>
                                </tr>
                                @endforeach
                            </table>

                        </div>
                        <!-- PRODUCT ITEM -->
                    </div>
                </div>
                <div class="home-filter_payment-method">
                    <div class="title__home-filter">
                        <i class="fa-regular fa-money-bill-1"></i>
                        <div class="title__home-page">Phương thức thanh toán</div>
                    </div>
                    <div class="payment-method__list">
                       <div class="payment-method__item active__method">Thanh toán khi nhận hàng</div>
                       <div class="payment-method__item">Thánh toán bằng cart</div>
                       <div class="payment-method__item">Chuyển khoản thanh toán</div>
                    </div>
                </div>

                <!-- PAYMENT -->
                <div class="grid payment__cart-item">
                    <div class="action__cart">
                        <div class="payment__cart-title">
                            Tổng tiền:
                            <span class="price_total-payment"> <input type="text" value="{{ $total }}" name="TotalAmount" style="display: none"> {{ $total }} <span>đ</span></span>
                        </div>
                        <div class="payment__cart-btn">
                            <button type="submit" class="btn btn--primary">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection