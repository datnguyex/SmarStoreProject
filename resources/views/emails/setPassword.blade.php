<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forget password</title>
    <link type="text/css" href="/css/main.css" rel="stylesheet">
    <link type="text/css" href="/css/base.css" rel="stylesheet">
    <link type="text/css" href="/css/seller.css" rel="stylesheet">
    <link type="text/scss" href="/scss/seller.scss" rel="stylesheet">
    <link type="text/css" href="/scss/profile.css" rel="stylesheet">
    <link type="text/css" href="/scss/product_detail.css" rel="stylesheet">
    <link rel="stylesheet" href="/font/fontawesome-free-6.5.1-web/css/all.min.css">
</head>

<body>
    <header class="header">
        <div class="grid">
            <nav class="header__navbar">
                <ul class="navbar-list">
                    @guest
                    <li class="navbar-item navbar-item--has-qr navbar-item--separate">
                        Vào cửa hàng ứng dụng mua sản phẩm
                        <div class="navbar__qr">
                            <img src="/img/QRcode.png" alt="" class="navbar__qr-img">
                            <div class="navbar__qr-apps">
                                <a href="" class="navbar__qr-link">
                                    <img src="/img/ggplay.png" class="navbar__qr-apps-img">
                                    </img></a>
                                <a href="" class="navbar__qr-link">
                                    <img src="/img/apple.png" class="navbar__qr-apps-img"></img>
                                </a>

                            </div>
                        </div>
                    </li>
                    @else
                    <li class="navbar-item">
                        <a href="{{ route('store.index') }}" class="navbar-item-link">
                            Trang người bán
                        </a>
                    </li>
                    @endguest


                </ul>
                <ul class="navbar__list">
                    <li class="navbar-item">
                        <a href="#" class="navbar-item-link">
                            <i class="navbar-icon-link fa-regular fa-circle-question"></i>
                            Trợ giúp
                        </a>
                    </li>
                    @guest
                    <li class="navbar-item navbar-item--strong navbar-item--separate">
                        <a href="{{ route('user.createUser') }}" class="navbar-item-link">
                            Đăng Ký
                        </a>
                    </li>
                    <li class="navbar-item navbar-item--strong">
                        <a href="{{ route('login') }}" class="navbar-item-link">
                            Đăng Nhập
                        </a>
                    </li>
                    @else
                    <!-- USER -->
                    <li class="navbar-item navbar-user">
                        <?php
                            if(!empty($_SESSION['user_id'])) {
                                echo '<img src="/img/user_img.jpg" alt="" class="navbar-user-img">
                                <span class="navbar-user-name">' .$_SESSION["user_name"]. '</span>';
                            }
                            ?>
                        <ul class="navbar-user-info">
                            <li class="navbar-user-item">
                                <a href="/account/profile" class="navbar-user-link">Tài khoản</a>
                            </li>
                            <li class="navbar-user-item">
                                <a href="" class="navbar-user-link">Đơn mua</a>
                            </li>
                            <li class="navbar-user-item">
                                <a href="{{ route('signOut') }}" class="navbar-user-link">Đăng xuất</a>
                            </li>
                        </ul>


                    </li>
                    @endguest
                    <!-- USER -->
                </ul>
            </nav>

            <!--HEADER WITH SEARCH -->
            <div class="header-with-search">
                <div class="header__logo">
                    <a href="/home" class="logo_link">
                        <i class="fa-solid fa-store logo_shop "></i>
                        <div class="name_header">
                            <span style="font-size: 1.8rem; with: 100%;">SMART</span>
                            <span class="name_shop">STORE</span>
                        </div>
                    </a>
                </div>

                <div class="header__icon-next" style="color: white; font-size: 2rem; margin-right: 33px;">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>

                <div class="header__title-page" style="color: white; font-size: 2rem;">
                    Quên mật khẩu
                </div>
            </div>

        </div>
    </header>

    <div class="grid__column-12">
        <div class="home_profile">
            <div class="grid__row">
                <div class="grid__column-12">
                    <div class="home__profile--info home__info--find">
                        <form method="post" action="{{ route('user.setPassword') }}" class="form_profile form_profile--password-forget">
                            @csrf
                            <div class="home__profile-item-forget">
                                <input name="otp" type="text" value="" placeholder="Nhập OTP của bạn" required title="">
                            </div>
                            <div class="home__profile-item-forget">
                                <input name="password_new" type="text" value="" placeholder="Nhập password mới" required title="vui lòng nhập email người dùng!">
                            </div>
                            <div class="btn__save">
                                <button class="btn save">Tiếp theo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>