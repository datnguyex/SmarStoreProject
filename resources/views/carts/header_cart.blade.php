<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link type="text/css" href="/css/main.css" rel="stylesheet">
    <link type="text/css" href="/css/base.css" rel="stylesheet">
    <link type="text/css" href="/css/seller.css" rel="stylesheet">
    <link type="text/css" href="/scss/cart.css" rel="stylesheet">
    <link type="text/css" href="/scss/payment.css" rel="stylesheet">
    <link type="text/scss" href="/scss/seller.scss" rel="stylesheet">
    <link rel="stylesheet" href="/font/fontawesome-free-6.5.1-web/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- HEADER -->
    <header class="header_cart">
        <div class="header_cart-item--top">
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="navbar-list">
                        <ul class="navbar-list">
                            <?php 
                            if(!empty($_SESSION['user_id'])) {
                        ?>
                            <li class="navbar-item navbar-item--has-qr navbar-item--separate">
                                Vào cửa hàng mua sản phẩm
                                <!-- <div class="navbar__qr">
                                <img src="/img/QRcode.png" alt="" class="navbar__qr-img">
                                <div class="navbar__qr-apps">
                                    <a href="" class="navbar__qr-link">
                                        <img src="/img/ggplay.png" class="navbar__qr-apps-img">
                                        </img></a>
                                    <a href="" class="navbar__qr-link">
                                        <img src="/img/apple.png" class="navbar__qr-apps-img"></img>
                                    </a>

                                </div>
                            </div> -->
                            </li>
                            <?php } else { ?>
                            <li class="navbar-item">
                                <a href="{{ route('seller.viewSeller') }}" class="navbar-item-link">
                                    Trang người bán
                                </a>
                            </li>
                            <?php } ?>


                        </ul>
                    </ul>
                    <ul class="navbar__list">
                        <li class="navbar-item navbar-item--has-notify">
                            <a href="#" class="navbar-item-link">
                                <i class="navbar-icon-link fa-solid fa-bell"></i>
                                Thông báo
                            </a>
                            <div class="navbar__notify">
                                <header class="navbar__notify-header">
                                    <h3>Thông báo mới nhận</h3>
                                </header>
                                <ul class="navbar__notify-list">
                                    <li class="navbar__notify-item navbar__notify-item--viewed">
                                        <a href="" class="navbar__notify-link">
                                            <span>
                                                <img src="/img/notify.jpg" alt="" class="navbar__notify-img">
                                            </span>
                                            <div class="navbar__notify-info">
                                                <span class="navbar__notify-name">Chúc mừng năm mới</span>
                                                <span class="navbar__notify-description">Mô tả</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            </form>
                        <li class="navbar-item">
                            <a href="#" class="navbar-item-link">
                                <i class="navbar-icon-link fa-regular fa-circle-question"></i>
                                Trợ giúp
                            </a>
                        </li>
                        <?php 
                            if(empty($_SESSION['user_id'])) {
                        ?>
                        <li class="navbar-item navbar-item--strong navbar-item--separate">
                            <a href="" class="modal__create navbar-item-link" data-bs-toggle="modal"
                                data-bs-target="#create">
                                Đăng Ký
                            </a>
                        </li>
                        <li class="navbar-item navbar-item--strong">
                            <a href="" class="get-modal__login navbar-item-link" data-bs-toggle="modal"
                                data-bs-target="#login">
                                Đăng Nhập
                            </a>
                        </li>
                        <?php } ?>
                        <!-- USER -->
                        <li class="navbar-item navbar-user">
                            <?php
                            if(!empty($_SESSION['user_id'])) {
                                echo '<img src="/img/user_img.jpg" alt="" class="navbar-user-img">
                                <span class="navbar-user-name">' .$_SESSION["name"]. '</span>';
                            }
                            ?>
                            <ul class="navbar-user-info">
                                <li class="navbar-user-item">
                                    <a href="{{ route('user.viewUserProfile') }}" class="navbar-user-link">Tài khoản</a>
                                </li>
                                <li class="navbar-user-item">
                                    <a href="" class="navbar-user-link">Đơn mua</a>
                                </li>
                                <li class="navbar-user-item">
                                    <a href="{{ route('signOut') }}" class="navbar-user-link">Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                        <!-- USER -->
                    </ul>
                </nav>
            </div>
        </div>
        <div class="header_cart-item--bottom">
            <div class="grid">
                <div class="header-with-search header-with-search-cart">
                    <div class="header__logo">
                        <a href="{{ route('home.index') }}" class="logo_link">
                            <i class="fa-solid fa-store logo_shop "></i>
                            <div class="name_header">
                                <span style="font-size: 1.8rem; with: 100%;">SMART</span>
                                <span class="name_shop">STORE</span>
                            </div>
                        </a>
                    </div>

                    <div class="header__icon-next">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>

                    <div class="header__title-page">
                        Giỏ hàng
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER -->

    <!-- CONTAINER -->
    <div class="app__container">
        <div class="grid">
            <div class="grid__row app__contents_seller ">
                <!--PAGE-->
                @yield('content_cart')
                <!--PAGE-->
            </div>
        </div>
    </div>

    <!-- CONTAINER -->
    <script src="/js/cart.js"></script>
    <script src="/js/app.js"></script>
</body>

</html>