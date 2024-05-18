@extends('auth.account.header')

@section('content_profile')
<!-- CONTAINER -->
<div class="grid__column-10">
    <div class="home__product">
        <div class="grid__row">
            <!-- pRODUCT ITEM -->
            <div class="grid__column-product_cart grid__column-product_order">
                <table class="table__product-cart" id="customers">
                    <tr class="">
                        <th>Tên sản phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Số lượng</th>
                        <th>Số tiền</th>
                    </tr>
                    @foreach($orders as $order)
                    <tr class="product__cart-item">
                        <td class="seller__td-img">
                            <div class="detail__product-info">
                                <img src="/img/img_auth/{{ $order->product->img }}" alt="" class="seller-img_product">
                                <a href="" class="information__product-link">
                                    <span class="seller-name_product">{{ $order->product->name }}</span>
                                    <span class="seller-description_product">{{ $order->product->description }}</span>
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="price__product-cart">{{ $order->product->price }}</span>
                            <span>đ</span>
                        </td>
                        <td>
                            <div class="quantity__cart">
                                <div class="number_quantity">{{ $order->quantity }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="total__product-cart">{{ $order->total }}</span>
                            <span>đ</span>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
            <!-- pRODUCT ITEM -->
            <div class="grid payment__cart-item">
                <div class="action__cart">
                    <div class="payment__cart-btn">
                        @if($status == "Transporting")
                        <button onclick="window.location.href='{{ route('orders.updateStatus', $id) }}'"
                            class="btn btn--primary">Hủy đơn hàng</button>
                        @else
                        <button class="btn btn--primary">Mua lại</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection