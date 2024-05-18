s<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="/css/base.css" rel="stylesheet">
    <link type="text/css" href="/css/main.css" rel="stylesheet">
    <link type="text/css" href="/scss/store.css" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <!-- modal -->
    <div class="modal">
        <div class="modal__overlay"></div>

        <div class="modal__body">
            <!-- Register form -->
            <form class="auth-form" method="POST" action="{{ route('user.postSeller') }}">
                @csrf
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng ký trang bán hàng</h3>
                    </div>

                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Name" name="name" value="Minh Hiệp">
                        </div>
                        
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Name" name="phone" value="54524432">
                        </div>
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Địa chỉ" name="address" value="Bình thành">
                        </div>
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Tên cửa hàng" name="name_company" value="Đại Lộc" >
                        </div>
                        <div class="auth-form__group">
                            <select name="type_business" class="form-select" aria-label="Default select example">
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
                                    <input name="sex" type="radio" value="female">
                                </div>
                                <div class="check check__sex-male">
                                    <label for="">Nữ</label>
                                    <input name="sex" type="radio" value="male">
                                </div>
                                <div class="check check__sex-dif">
                                    <label for="">Khác</label>
                                    <input name="sex" type="radio" value="other">
                                </div>
                            </div>
                        </div>
                        <div class="auth-form__group">
                        <label for="">Ngày sinh</label>
                            <select name="day" class="check form-select" aria-label="Default select example">
                                @for ($i = 1; $i <= 31; $i++) : ?>
                                    @if($i==1)
                                        <option selected value="<?= $i ?>"><?= $i ?></option>
                                    @endif;
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                @endfor;
                            </select>
                            <select name="month" class="check form-select" aria-label="Default select example">
                                <?php for ($i = 1; $i <= 12; $i++) : if($i == 1) : ?>
                                    <option selected value="<?= $i ?>"><?= $i ?></option>
                                <?php endif;?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php  endfor; ?>
                            </select>
                            <select name="year" class="check form-select" aria-label="Default select example">
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
</body>

</html>