<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link type="text/css" href="/css/main.css" rel="stylesheet">
    <link type="text/css" href="/css/base.css" rel="stylesheet">
    <link type="text/css" href="/css/seller.css" rel="stylesheet">
    <link type="text/scss" href="/scss/seller.scss" rel="stylesheet">
    <link type="text/css" href="/scss/profile.css" rel="stylesheet">
    <link type="text/css" href="/scss/product_detail.css" rel="stylesheet">
    <link type="text/css" href="/scss/store.css" rel="stylesheet">
    <link type="text/css" href="/scss/product.css" rel="stylesheet">
    <link rel="stylesheet" href="/font/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <!-- HEADER -->
        <header class="header">
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="navbar-list">
                        <?php 
                            if(empty($_SESSION['user_id'])) {
                        ?>
                        <li class="navbar-item navbar-item--has-qr navbar-item--separate">
                            Vào cửa hàng ứng dụng mua sản phẩm
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
                          if (!empty($_SESSION['user_id'])) {
                            echo '<img src="/img/img_auth/' . $_SESSION["img"] . '" alt="" class="navbar-user-img">
                                  <span class="navbar-user-name">' . $_SESSION["name"] . '</span>';
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

                <!--HEADER WITH SEARCH -->
                <div class="header-with-search">
                    <div class="header__logo">
                        <a href="{{ route('home.index') }}" class="logo_link">
                            <i class="fa-solid fa-store logo_shop "></i>
                            <div class="name_header">
                                <span style="font-size: 1.8rem; with: 100%;">SMART</span>
                                <span class="name_shop">STORE</span>
                            </div>
                        </a>
                    </div>

                    <form class="header__search" action="{{ route('find.index')}}" method="GET">
                        <div class="header__search-input-wrap">
                            <input name="key" type="text" class="header__search-input"
                                placeholder="Nhập sản phẩm tìm kiếm" autocomplete="off">
                            <div class="header__search-history">
                                <ul class="list-group header__search-history-list list-search">

                                </ul>
                            </div>
                        </div>

                        <div class="search-select">
                            <span class="search-title">Trong Shop</span>
                            <i class="search-icon fa-solid fa-angle-down"></i>
                            <ul class="search-option">
                                <li class="search-option-item search-option-item-action">
                                    <span>Trong Shop</span>
                                    <i class="fa-solid fa-check"></i>
                                </li>
                                <li class="search-option-item">
                                    <Span>Ngoài Shop</Span>
                                    <i class="fa-solid fa-check"></i>
                                </li>
                            </ul>
                        </div>

                        <button class="search-btn">
                            <i class="search-btn-icon fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>

                    <!-- HEADER WITH CART -->
                    <div class="header__cart">
                        <div class="header__cart-wrap">
                            <i class="cart-icon fa-solid fa-cart-shopping">
                                <!-- <?php if (!empty($_SESSION['user_id'])) {
                                ?>
                                    <span class="number_cart"></span>
                                <?php } else {?>
                                    <span class="number_cart">0</span>
                                <?php }?> -->
                            </i>

                            <div class="header__cart-list header__cart-no-cart">
                                <!-- <img src="/img/no-cart.png" alt="" class="header__cart-no-cart-img">
                                    <span class="header__cart-message">Chưa có sản phẩm</span> -->

                                <h3 class="cart-heading">Sản phẩm đã thêm</h3>
                                <ul class="cart-list-item">
                                    <!-- cart-item -->
                                    <li class="cart-item">
                                        <img src="https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lia0026vdexeff"
                                            alt="" class="cart-item-img">
                                        <div class="cart-item-info">
                                            <div class="cart-item-header">
                                                <h5 class="cart-item-name">Bộ kem đặc trị vùng mắt Bộ kem đặc trị vùng
                                                    mắt Bộ kem đặc trị vùng mắt Bộ kem đặc trị vùng mắt Bộ kem đặc trị
                                                    vùng mắt Bộ kem đặc trị vùng mắt</h5>
                                                <div class="cart-item-price-qnt">
                                                    <span class="cart-item-price">2.000,000đ</span>
                                                    <span class="cart-item-multiply">x</span>
                                                    <span class="cart-item-qnt">1</span>
                                                </div>
                                            </div>
                                            <div class="cart-item-body">
                                                <span class="cart-item-description">Phân loại: Bạc</span>
                                                <span class="cart-item-delete">Xóa</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="cart-item">
                                        <img src="https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lia0026vdexeff"
                                            alt="" class="cart-item-img">
                                        <div class="cart-item-info">
                                            <div class="cart-item-header">
                                                <h5 class="cart-item-name">Bộ kem đặc trị vùng mắt</h5>
                                                <div class="cart-item-price-qnt">
                                                    <span class="cart-item-price">2.000,000đ</span>
                                                    <span class="cart-item-multiply">x</span>
                                                    <span class="cart-item-qnt">1</span>
                                                </div>
                                            </div>
                                            <div class="cart-item-body">
                                                <span class="cart-item-description">Phân loại: Bạc</span>
                                                <span class="cart-item-delete">Xóa</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <button onclick="window.location.href='{{ route('cart.index') }}'"
                                    class="header__cart-view btn btn--primary">Xem giỏ hàng</button>
                            </div>

                        </div>
                    </div>
                    <!-- HEADER WITH CART -->
                </div>

            </div>
        </header>
        <!-- /HEADER -->

        @yield('content')

        <!-- FOOTER  -->
        <footer class="footer">
            <div class="title_footer">
                Nhóm E Thực Hiện: ĐỒ ÁN MÔN BACK-END
            </div>
        </footer>
        <!-- FOOTER  -->

    </div>

    <!-- Login -->
    <div class="modal-header">
        <div class="modal_body">
            <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="margin-top: 8%;">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('user.authUser') }}" class="auth-form">
                            @csrf
                            <div class="auth-form__container">
                                <div class="auth-form__header">
                                    <h3 class="auth-form__heading">Đăng nhập</h3>
                                    <span class="auth-form__switch-btn">Đăng ký</span>
                                </div>

                                <div class="auth-form__form">
                                    <div class="auth-form__group">
                                        <input type="text" class="auth-form__input" placeholder="Email" id="email"
                                            class="form-control" name="email" required title="Không được bỏ trống">
                                    </div>
                                    <div class="auth-form__group">
                                        <input type="password" class="auth-form__input" placeholder="Password"
                                            id="password" class="form-control" name="password" required
                                            title="Không được bỏ trống">
                                    </div>
                                    <div class="auth-form__group">
                                        <div class="verify_user">
                                            <input class="label_number" for="" name="get__number_verify"
                                                readonly></input>
                                            <input type="text" class="auth-form__input" placeholder="Enter"
                                                name="number_verify" required title="Không được bỏ trống">
                                        </div>
                                    </div>
                                </div>
                                @if (session('pass_wrong'))
                                    <p class="error-message">Mật khẩu hoặc email không chính xác. Vui lòng thử lại.</p>
                                @elseif (session('otp_wrong'))
                                    <p class="error-message">OTP không chính xác. Vui lòng thử lại.</p>
                                @elseif (session('success'))
                                    <p class="success">Đăng ký thành công. Vui lòng đăng nhập</p>
                                @endif
                                
                                <div class="auth-form__aside">
                                    <p class="auth-form__help">
                                        <a href="{{ route('forget.index') }}"
                                            class="auth-form__help-link auth-form__help-forgot">Quên mật khẩu</a>
                                        <span class="auth-form__help-separate"></span>
                                        <a href="" class="auth-form__help-link">Cần trợ giúp?</a>
                                    </p>
                                </div>

                                <div class="auth-form__controls">
                                    <button type="button" onclick="window.location.href='{{ route('home.index') }}'"
                                        class="btn btn__normal btn__move">TRỞ LẠI</button>
                                    <button type="submit" class="btn btn--primary">ĐĂNG NHẬP</button>
                                </div>
                            </div>

                            <div class="auth-form__socials">
                                <a href="" class="btn btn__size-s btn--with-icon btn__icon-fb">
                                    <i class="auth-form__socials-icon fa-brands fa-square-facebook"></i>
                                    <span>Kết nối với Facebook</span>
                                </a>
                                <a href="" class="btn btn__size-s btn--with-icon btn__icon-google">
                                    <i class="auth-form__socials-icon fa-brands fa-google"></i>
                                    <span>Kết nối với Google</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- CREATE_STORE -->
            <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="margin-top: 5%;">
                    <div class="modal-content">
                        <form class="auth-form" method="POST" action="{{ route('user.postUser') }}">
                            @csrf
                            <div class="auth-form__container">
                                <div class="auth-form__header">
                                    <h3 class="auth-form__heading">Đăng ký</h3>
                                    <span class="auth-form__switch-btn">Đăng nhập</span>
                                </div>

                                <div class="auth-form__form">
                                    <div class="auth-form__group">
                                        <input type="text" class="auth-form__input" placeholder="Name" name="name"
                                            required>
                                    </div>
                                    <div class="auth-form__group">
                                        <input type="text" class="auth-form__input" placeholder="Email" name="email"
                                            required>
                                    </div>

                                    <div class="auth-form__group">
                                        <input type="password" class="auth-form__input" placeholder="Password"
                                            name="password" required>
                                    </div>
                                </div>
                                @if (session('exit_email'))
                                    <p class="error-message">Email đã tồn tại. Vui lòng thử lại.</p>
                                @elseif (session('invalid_pass'))
                                    <p class="error-message">Mật khẩu phải hơn 6 số. Vui lòng thử lại.</p>
                                @endif
                                <div class="auth-form__aside">
                                    <p class="auth-form__policy-text">
                                        Bằng việc đăng ký, bạn đã đồng ý với SmartStore về
                                        <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a>
                                        &
                                        <a href="" class="auth-form__text-link">Chính xác bảo mật</a>
                                    </p>
                                </div>

                                <div class="auth-form__controls">
                                    <button type="button" onclick="window.location.href='{{ route('home.index')}}'"
                                        class="btn btn__normal btn__move">TRỞ LẠI</button>

                                    <button type="submit" class="btn btn--primary">ĐĂNG KÝ</button>
                                </div>
                            </div>

                            <div class="auth-form__socials">
                                <a href="" class="btn btn__size-s btn--with-icon btn__icon-fb">
                                    <i class="auth-form__socials-icon fa-brands fa-square-facebook"></i>
                                    <span>Kết nối với Facebook</span>

                                </a>
                                <a href="" class="btn btn__size-s btn--with-icon btn__icon-google">
                                    <i class="auth-form__socials-icon fa-brands fa-google"></i>
                                    <span>Kết nối với Google</span>

                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /CREATE -->

            <!-- CREATE_STORE -->
            <div class="modal fade" id="store" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="margin-top: 5%;">
                    <div class="modal-content">
                        <form class="auth-form" method="POST" action="{{ route('user.postSeller') }}">
                            @csrf
                            <div class="auth-form__container">
                                <div class="auth-form__header">
                                    <h3 class="auth-form__heading">Đăng ký trang bán hàng</h3>
                                </div>

                                <div class="auth-form__form">
                                    <div class="auth-form__group">
                                        <input type="text" class="auth-form__input" placeholder="Name" name="name"
                                            value="Minh Hiệp">
                                    </div>

                                    <div class="auth-form__group">
                                        <input type="text" class="auth-form__input" placeholder="Name" name="phone"
                                            value="54524432">
                                    </div>
                                    <div class="auth-form__group">
                                        <input type="text" class="auth-form__input" placeholder="Địa chỉ" name="address"
                                            value="Bình thành">
                                    </div>
                                    <div class="auth-form__group">
                                        <input type="text" class="auth-form__input" placeholder="Tên cửa hàng"
                                            name="name_company" value="Đại Lộc">
                                    </div>
                                    <div class="auth-form__group">
                                        <select name="type_business" class="form-select"
                                            aria-label="Default select example">
                                            <option selected>Kiểu kinh doanh</option>
                                            <option selected value="individual">Cá nhân</option>
                                            <option value="enterprise">Doanh nghiẹp</option>
                                        </select>
                                    </div>
                                    <div class="auth-form__group">
                                        <label for="">Giới tính</label>
                                        <div class="check__sex">
                                            <div class="check check__sex-female">
                                                <label for="">Nam</label>
                                                <input name="sex" type="radio" value="nam">
                                            </div>
                                            <div class="check check__sex-male">
                                                <label for="">Nữ</label>
                                                <input name="sex" type="radio" value="nữ">
                                            </div>
                                            <div class="check check__sex-dif">
                                                <label for="">Khác</label>
                                                <input name="sex" type="radio" value="khác">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="auth-form__group">
                                        <label for="">Ngày sinh</label>
                                        <select name="day" class="check form-select"
                                            aria-label="Default select example">
                                            @for ($i = 1; $i <= 31; $i++) : ?>
                                                @if($i==1)
                                                <option selected value="<?= $i ?>"><?= $i ?></option>
                                                @endif;
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                                @endfor;
                                        </select>
                                        <select name="month" class="check form-select"
                                            aria-label="Default select example">
                                            <?php for ($i = 1; $i <= 12; $i++) : if($i == 1) : ?>
                                            <option selected value="<?= $i ?>"><?= $i ?></option>
                                            <?php endif;?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php  endfor; ?>
                                        </select>
                                        <select name="year" class="check form-select"
                                            aria-label="Default select example">
                                            <option value="">Năm</option>
                                            <?php for ($i = date('Y'); $i >= 1900; $i--) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php if($i == 1990) : ?>
                                            <option selected value="<?= $i ?>"><?= $i ?></option>
                                            <?php endif;?>

                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="auth-form__aside">
                                    <p class="auth-form__policy-text">
                                        Bằng việc đăng ký, bạn đã đồng ý với Smart store về
                                        <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a>
                                        &
                                        <a href="" class="auth-form__text-link">Chính xác bảo mật</a>
                                    </p>
                                </div>

                                <div class="auth-form__controls">
                                    <button type="button" onclick="window.location.href='{{ route('home.index')}}'"
                                        class="btn btn__normal btn__move">TRỞ LẠI</button>

                                    <button type="submit" class="btn btn--primary">ĐĂNG KÝ</button>
                                </div>
                            </div>

                            <div class="auth-form__socials">
                                <a href="" class="btn btn__size-s btn--with-icon btn__icon-fb">
                                    <i class="auth-form__socials-icon fa-brands fa-square-facebook"></i>
                                    <span>Kết nối với Facebook</span>

                                </a>
                                <a href="" class="btn btn__size-s btn--with-icon btn__icon-google">
                                    <i class="auth-form__socials-icon fa-brands fa-google"></i>
                                    <span>Kết nối với Google</span>

                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /CREATE_STORE -->

            <!-- SUCCESS -->
            <div class="modal fade" id="success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="margin-top: 5%;">
                    <div class="modal-content">
                        <div class="modal__body">
                            <div class="content-success">
                                <h3>Thành công
                                    <i class="fa-regular fa-circle-check"></i>
                                </h3>
                            </div>
                            <div class="comeback-btn">
                                <button onclick="window.location.href='{{ route('home.index') }}'"
                                    class="auth-form btn btn--primary">
                                    Trang chủ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /SUCCESS -->

        </div>
    </div>

    <script src="/js/action.js"></script>
    <script src="/js/dropdown.js"></script>
    <script src="/js/verify.js"></script>
    <script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mark.js@8.11.1/dist/mark.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @if (session('login'))
    <script>
    window.onload = function() {
        var myModal = new bootstrap.Modal(document.getElementById('login'));
        myModal.show();
    };
    </script>
    @elseif (session('register'))
    <script>
    window.onload = function() {
        var myModal = new bootstrap.Modal(document.getElementById('create'));
        myModal.show();
    };
    </script>
    @elseif (session('create_store'))
    <script>
    window.onload = function() {
        var myModal = new bootstrap.Modal(document.getElementById('store'));
        myModal.show();
    };
    </script>
    @elseif (session('success'))
    <script>
    window.onload = function() {
        var myModal = new bootstrap.Modal(document.getElementById('success'));
        myModal.show();
    };
    </script>
    @endif
</body>

</html>