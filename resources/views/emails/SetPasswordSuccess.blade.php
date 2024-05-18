<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link type="text/css" href="/css/base.css" rel="stylesheet">
    <link type="text/css" href="/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="/font/fontawesome-free-6.5.1-web/css/all.min.css">
</head>
<body>
    <!-- modal -->
    <div class="modal">
        <div class="modal__overlay"></div>
        <div class="modal__body">
            <div class="content-success">
                <h3>Thành công
                    <i class="fa-regular fa-circle-check"></i>
                </h3>
            </div>
            <div class="comeback-btn">
                <button onclick="window.location.href='{{ route('home.index') }}'" class="auth-form btn btn--primary">
                    Trang chủ
                </button>
            </div>
        </div>
    </div>
</body>
</html>
