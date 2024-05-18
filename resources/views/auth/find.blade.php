@extends('header')

@section('content')
<!-- CONTAINER -->
<div class="app__container">
    <div class="grid">
        <div class="grid__row app__contents">
            <!-- CATEGORY -->
            <div class="gird__column-2">
                <nav class="category">
                    <h3 class="category__heading">
                        Danh mục
                    </h3>
                    <ul class="category-list">
                        @foreach($categories as $category) 
                        <li class="category-item ">
                            <a href="{{ route('find.show' ,$category->category_id )}}" class="category-item__link">{{ $category->category_name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <!-- CATEGORY -->

            <div class="grid__column-10">
                <div class="home-filter">
                    <span class="home-filter-title">Sắp xếp theo</span>
                    <button class="home-filter__btn btn">Phổ biến</button>
                    <button class="home-filter__btn btn btn--primary">Mới nhất</button>
                    <button class="home-filter__btn btn">Bán chạy</button>

                    <div class="select-input">
                        <span class="home-filter__label" for="">Giá</span>
                        <i class="search-icon fa-solid fa-angle-down"></i>

                        <!-- SELECT-INPUT-LIST -->
                        <ul class="select-input__list">
                            <li class="select-input__item">
                                <a href="" class="select-input__link">Giá: cao đến thấp</a>
                            </li>
                            <li class="select-input__item">
                                <a href="" class="select-input__link">Giá: thấp đến cao</a>
                            </li>
                        </ul>
                    </div>

                    <div class="home-filter__paginate">
                        <span class="home-filter__page-num">
                            <span class="page-current">1</span>
                            /14
                        </span>

                        <div class="home-filter__page-control">
                            <a href="" class="page-control-link page-control-link-icon-disabled">
                                <i class="page-control-link-icon fa-solid fa-angle-left"></i>
                            </a>
                            <a href="" class="page-control-link">
                                <i class="page-control-link-icon fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="home__product">
                    <div class="grid__row">
                        @foreach($products as $product) 
                        <!-- PRODUCT ITEM -->
                        <div class="grid__column-2-4">
                            <a href="/product_detail" class="product-item">
                                <div class="product-item__img"
                                    style="background-image: url(/img/img_auth/iphone-15.webp);">
                                </div>
                                <h4 class="product-item__name">{{ $product->product_name }}</h4>
                                <div class="product-item__price">
                                    <span class="product-item__price_old">{{ $product->price }}</span>
                                    <span class="product-item__price_current">{{ $product->price }}</span>
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
                                        <span class="product-item__star--sold-quantity">{{ $product->sold }}</span>
                                        Đã bán
                                    </span>
                                </div>
                                <div class="product-item__origin">
                                    <span class="product-item__brand"></span>
                                    <span class="product-item__origin-name">{{ $product->seller->name }}</span>
                                </div>
                            </a>
                        </div>
                        <!-- PRODUCT ITEM -->
                        @endforeach
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
<!-- /CONTAINER -->
@endsection
