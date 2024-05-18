@extends('store.header_store')

@section('content_store')
<div class="grid__column-10">
    <div class="home__product">
        <div class="grid__row">
            <!-- PRODUCT ITEM -->
            <div class="grid__column-order">
                <table id="customers">
                    <tr>
                        <th>Thông tin đơn hàng</th>
                        <th>Tổng tiền</th>
                        <th>Phương thức thanh toán</th>
                        <th>Trang thái đơn hàng</th>
                        <th>Thao tác</th>
                    </tr>
                    @foreach($order as $or)
                    <tr>
                        <td>{{$or->Order_Describe }}</td>
                        <td>{{$or->TotalAmount }}</td>
                        <td>{{$or->PaymentMethod }}</td>
                        <td>{{$or->PaymentStatus }}</td>
                        <td class="action__product">
                            @if($or->PaymentStatus == "Completed")
                                <a href="{{ route('orders.delete', $or->id) }}" class="seller__product-delete">Xóa</a>
                            @else
                                <a href="" class="seller__product-delete">Mua lại</a>
                            @endif
                                <a href="{{ route('orders.show', $or->id) }}" class="seller__product-detail">Xem chi
                                tiết</a>
                        </td>
                    </tr>
                    @endforeach

                </table>
            </div>
            <!-- PRODUCT ITEM -->
        </div>
    </div>
</div>

@endsection