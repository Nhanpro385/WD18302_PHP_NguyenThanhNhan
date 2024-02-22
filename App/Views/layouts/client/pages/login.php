<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Admin LTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.min.css" integrity="sha512-zR9SwE1PKjPQWm8zZU5X6ZBqD7+vTCVQqY6Yr1YozLfku6ubveNw3edwO7c2pS0XtT/npRzTK1ixD6ptW0DzTw==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Đăng Nhập</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc của bạn</p>

            <form id="loginForm" method="post" action="?url=LoginController/handleLogin">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Ghi nhớ tài khoản</label>
                        </div>
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                    </div>
                </div>
            </form>
            <div style="display: flex; justify-content: space-between;">
                <p class="mb-1">
                    <a href="?url=ForgotPasswordController/forgotPage" class="mr-2"><i class="fas fa-question"></i> Quên mật khẩu ?</a>
                </p>
                <p class="mb-1">
                    <a href="?url=RegisterController/registerPage"><i class="fas fa-user-plus"></i> Đăng ký ngay!</a>
                </p>
            </div>

        </div>
    </div>
</div>

<!-- Admin LTE JS and dependencies -->
<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(e) {
            e.preventDefault();

            // Lấy dữ liệu từ biểu mẫu
            var formData = $(this).serialize();

            // Gửi yêu cầu Ajax
            $.ajax({
                type: 'POST',
                url: '?url=LoginController/handleLogin',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        // Hiển thị thông báo lỗi
                        Swal.fire({
                            icon: 'error',
                            title: 'Đăng nhập thất bại!',
                            text: response.error
                        });
                    } else if (response.success) {
                        // Hiển thị thông báo thành công và chuyển hướng sau 2 giây
                        Swal.fire({
                            icon: 'success',
                            title: 'Đăng nhập thành công!',
                            text: response.success
                        }).then(function() {
                            window.location.href = response.redirect;
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi Ajax
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

</body>
</html>
