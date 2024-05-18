@extends('header')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
<link rel="stylesheet" href="/font/fontawesome-free-6.5.1-web/css/all.min.css">
<div class="app__container">
    <div class="grid">
        <div class="grid__row app__contents_seller ">
            <!-- CATEGORY -->
            <div class="grid__column-5">
                <div class="product__img-detail">
                    <img class="img__product-detail" src="{{('img/img_auth/' . $product->img) }}"></img>
                </div>
            </div>
            <!-- CATEGORY -->

            <div class="grid__column-7">
                <div class="title_product-detail">
                    <div class="product-detail-name">{{$product->product_name}}</div>
                    <div class="product-detail-id" style="display: none;">{{$product->id}}</div>
                    <div class="product-detail-info">
                        <div class="product-detail-rate">
                            @if($evarageStars > 0)
                             @php
                                $floorEvarageStars = floor($evarageStars);
                            @endphp
                            @for($i = 1; $i <= $floorEvarageStars; $i++) 
                                <i class="product-item__star--gold fa-solid fa-star"></i>
                            @endfor

                            @if(is_float($evarageStars)) 
                            <i id="star-gradient" class="fa-solid fa-star"></i>
                            @endif
                            @endif
                          
                        </div>
                        <div class="product-detail product-detail-Evaluate">Đánh giá</div>
                        <div class="product-detail product-detail-sold">Đã bán</div>
                    </div>
                    <div class="product-detail-cate">{{$product->category->category_name}}</div>
                    <div class="product-detail-price">{{$product->price}}<span>đ</span></div>
                    <div class="product-detail-des">{{$product->description}}</div>
                    <div class="product-detail-action">
                        <div class="product-detail-quantity">{{$product->quantity}}</div>
                        <div class="product-detail-quantities">
                            <div class="product-detail-add">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <div class="product-detail-number">1</div>
                            <div class="product-detail-sub">
                                <i class="fa-solid fa-minus"></i>
                            </div>
                        </div>
                        <div class="product-detail-sold"><span>{{$product->quantity - $product->sold}}</span>Sản phẩm còn lại</div>
                    </div>
                    <div class="product-detail-button">
                        <div class="btn btn--cart">
                            <i class="fa-solid fa-cart-plus"></i>
                            Thêm vào giỏ hàng
                        </div>
                        <div id="btnPrimary" class="btn btn--primary">Mua ngay</div>
                    </div>

                </div>
            </div>

            <!-- USER -->
            <div class="grid__column-12">
                <div class="info__shop">
                    <img class="info__shop-img" src="{{('img/img_auth/' . $seller->img)}}">
                    <div class="info__shop-item">
                        <div class="info__shop-information">
                        <div class="info__shop-name">{{ $seller->name }}</div>
                            <div class="info__shop-phone">{{$seller->phone}}</div>
                        </div>
                        <div class="info__shop-btn">
                           <form action="" method="post">
                           @csrf 
                           <button id="seeShopDetail" type="submit" class="btn info__shop-btn__see">
                                <input name="id_seller" value="{{$product->seller_id}}" type="hidden">
                                <i class="fa-regular fa-eye"></i>
                                Xem shop
                            </button>
                           </form>
                            <button id="chatShopDetail" class="btn btn--primary info__shop-btn__chat">
                                Chat shop
                                <i class="fa-regular fa-comment"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- USER -->

            <div class="grid__column-12">
                <div class="title__home-product">
                    <div class="title__home">Gợi ý liên quan</div>
                </div>

                <div class="home__product">
                    <div class="grid__row">
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">Sữa bột Similac 4 900g/lon Dinh Dưỡng 5G, Dinh Dưỡng 600G
                                    Mới</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">1.200.000đ</span>
                                    <span class="product-item__price_current">999.000đ</span>
                                </div>
                                <div class="product-item__action">
                                    <span class="product-item_like product-item_liked">
                                        <i class="product-item_like-icon-empty fa-regular fa-heart"></i>
                                        <i class="product-item_liked-icon-fill fa-solid fa-heart"></i>
                                    </span>
                                    <div class="product-item__rating">
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class="product-item__star--gold fa-solid fa-star"></i>
                                        <i class=" fa-solid fa-star"></i>
                                    </div>
                                    <span class="product-item__sold">
                                        <span class="product-item__star--sold-quantity">88</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand">Whoo</span>
                                    <span class="product-item__origin-name">Nhật bản</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                    </div>
                </div>

                <!-- PAGINATION -->
                <ul class="pagination home__product-pagination">
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">
                            <i class="pagination-item__icon fa-solid fa-angle-left"></i>
                        </a>
                    </li>
                    <li class="pagination-item pagination-item--active">
                        <a href="" class="pagination-item__link">1</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">2</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">3</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">...</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">10</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">
                            <i class="pagination-item__icon fa-solid fa-angle-right"></i>
                        </a>
                    </li>

                </ul>
                <!-- PAGINATION -->
            </div>
        </div>
    </div>
</div>

<div class="viewComment">
    <h2>{{$product->product_name}}</h2>
    <div class="totalComment">
        <div class="groupStar">
            <h5>{{round($evarageStars,1)}}</h5>
            <h5 style="opacity: 0">.</h5>
         

            @if($evarageStars > 0)
    @php
        $floorEvarageStars = floor($evarageStars);
    @endphp

    @for($i = 1; $i <= $floorEvarageStars; $i++) 
        <i class="fa-solid fa-star"></i>
    @endfor

    @if(is_float($evarageStars)) 
        <i id="star-gradient" class="fa-solid fa-star"></i>
    @endif

@endif
           
            <h5 style="opacity: 0">.</h5>
            <p>{{$totalComments}} </p>
            <p style="opacity: 0">.</p>
            <p> Đánh Giá</p>
        </div>
    </div>
    <!-- Star ratings -->
    <div class="oneStar">
        <div class="groupStart">
            <p>1</p>
            <p style="opacity: 0;">.</p>
            <i class="fa-solid fa-star"></i>
        </div>
        <div class="progress">
            <div class="progress-bar bg-warning" style="width:{{$percenOneStar}}%"></div>
        </div>
        <p>{{$percenOneStar}}%</p>
    </div>
   
    <div class="twoStar">
        <div class="groupStart">
         <p>2</p>
         <p style="opacity: 0;">.</p>
        <i class="fa-solid fa-star"></i>
        </div>
        <div class="progress">
           <div class="progress-bar bg-warning" style="width:{{$percenTwoStar}}%"></div>
        </div>
        <p>{{$percenTwoStar}}%</p>
        </div>

        <div class="threeStar">
        <div class="groupStart">
         <p>3</p>
         <p style="opacity: 0;">.</p>
        <i class="fa-solid fa-star"></i>
        </div>
        <div class="progress">
           <div class="progress-bar bg-warning" style="width:{{$percenThreeStar}}%"></div>
        </div>
        <p>{{$percenThreeStar}}%</p>
        </div>

        <div class="fourStar">
        <div class="groupStart">
         <p>4</p>
         <p style="opacity: 0;">.</p>
        <i class="fa-solid fa-star"></i>
        </div>
        <div class="progress">
           <div class="progress-bar bg-warning" style="width:{{$percenFourStar}}%"></div>
        </div>
        <p>{{$percenFourStar}}%</p>
        </div>

        <div class="fiveStar">
        <div class="groupStart">
         <p>5</p>
         <p style="opacity: 0;">.</p>
        <i class="fa-solid fa-star"></i>
        </div>
        <div class="progress">
           <div class="progress-bar bg-warning" style="width:{{$percenFiveStar}}%"></div>
        </div>
        <p>{{$percenFiveStar}}%</p>
        </div>
    <!-- Title for filtering -->
    <!-- <div class="titleFilterEva">
        <h2>Lọc Đánh Giá</h2>   
    </div> -->
    <!-- <form action="" method="">
    <div class="filterEvaluate">
        <button  type="submit"  class="all" placeholder="">
            <a href="">Tất cả</a>
        </button>
        <button type="submit" class="fiveStar">
          <a href=""><p>5</p></a>
           <a href=""><i class="fa-solid fa-star"></i></a>
        </button>
        <button class="fourStar">
           <a href=""> <p>4</p></a>
            <a href=""><i class="fa-solid fa-star"></i></a>
        </button>
        <button class="threeStar">
           <a href=""><p>3</p></a>
          <a href=""><i class="fa-solid fa-star"></i></a>
        </button>
        <button class="twoStar">
           <a href=""><p>2</p></a>
          <a href="">  <i class="fa-solid fa-star"></i></a>
        </button>
        <button class="oneStar">
           <a href=""><p>1</p></a>
          <a href=""> <i class="fa-solid fa-star"></i></a>
        </button>
     </div>
    </form> -->

    <!-- Filtering options -->
  

    <!-- User comments -->
    
    @foreach($userComments as $userComment)
    <div class="CommentUser">
        <div class="nameUser">
            <h4>{{$userComment->CustomerUser->name}}</h4>
          
            <i class="fa-solid fa-circle-check"></i>
            <p>Đã mua tại Smartstore</p>
        </div>
        <div class="commentUserStar">
        @for ($i = 0; $i < $userComment->star; $i++)
        <i class="fa-solid fa-star"></i>
        @endfor
        </div>
        <div class="CommentImageUser">
            <img src="{{('img/img_auth/' . $userComment->img) }}" alt="">
        </div>
        <div class="commentUserContent">
            <p>{{$userComment->description}}</p>
           
        </div>
        <div class="ThanhNgang"></div>
    </div>
    @endforeach
</div> <!-- Closing viewComment div -->

   

    
<form method="POST" action="{{ route('user.formComment')}}" enctype="multipart/form-data">
@csrf 
   <div id="formComment" class="formComment">
      <div class="formCommentImg">
         <img src="{{('img/img_auth/' . $product->img) }}" alt="">
      </div>
     <div class="formCommentName">
     </div>
     <div class="formCommentContent">
     <textarea id="descriptionDetail" name="description" placeholder="Chia sẻ cảm nhận..." id="w3review" name="w3review" rows="4" cols="60"></textarea>
   
     </div>
     <label for="fiveStartForm">5 Sao</label>
     <input name="star" value="5" id="fiveStartForm" type="radio">
     <label for="fourStartForm">4 Sao</label>
     <input name="star" value="4" id="fourStartForm" type="radio">
     <label for="threeStartForm">3 Sao</label>
     <input name="star" value="3" id="threeStartForm" type="radio">
     <label for="twoStartForm">2 Sao</label>
     <input name="star" value="2" id="twoStartForm" type="radio">
     <label for="oneStartForm">1 Sao</label>
     <input name="star" value="1" id="oneStartForm" type="radio">
     <div class="formCommentImg">
     <button class="btn--textFile" onclick="document.getElementById('getFile').click()">
      <i class="fa-solid fa-camera"></i>
      <input id="imgComment" class="" type='file' id="getFile" style="" name="img">                  
     </button>
      <p id="sendImage" onclick="document.getElementById('getFile').click()">Gửi ảnh thực tế</p>
     </div>
     <input name="productId" value="{{$product->id}}" type="">
     <input id="customerUserId" name="customerUserId" value="{{ $customerUserId }}" type="text">
     <button type="submit" class="btn-submit">Gửi Đánh Giá</button>
    </div>
   </form>
   <script>

let formComment = document.getElementById('formComment');
let customerUserId = document.getElementById('customerUserId');
 if(customerUserId.value === '0') {
    formComment.style.display = 'none';
 }

</script>
@endsection
