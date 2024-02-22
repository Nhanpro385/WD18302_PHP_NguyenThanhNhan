<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.min.css" integrity="sha512-zR9SwE1PKjPQWm8zZU5X6ZBqD7+vTCVQqY6Yr1YozLfku6ubveNw3edwO7c2pS0XtT/npRzTK1ixD6ptW0DzTw==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Admin</b>LTE</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Đăng ký thành viên mới</p>



            <form <form id="registerForm" onsubmit="registerUser(); return false;" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Tên" name="name" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="tel" class="form-control" placeholder="Số điện thoại" name="phone" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Địa chỉ" name="address" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-map-marker-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Mật khẩu" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Xác nhận mật khẩu" name="confirm_password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" value="Đăng ký">Đăng ký</button>
                    </div>
                </div>
            </form>

            <a href="?url=LoginController/loginPage" class="text-center">Đã có tài khoản? Đăng nhập ngay!</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.min.js" integrity="sha512-btI66ve7fQgZDNoDwW+Xk4rFFop6e4dCwczgWp5vRcZT/A3DgLEbF8xP5UX/3oUsr6VtMlmX4g9rW9gnU6IVbg==" crossorigin="anonymous" defer></script>
<!-- AdminLTE Script -->
<script>
    function registerUser() {
        var formData = new FormData(document.getElementById("registerForm"));

        $.ajax({
            type: "POST",
            url: "?url=RegisterController/handleRegister", //  // Đường dẫn trực tiếp đến tệp và phương thức của controller
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Xử lý phản hồi từ server
                if (response.success) {
                    // Nếu đăng ký thành công, hiển thị thông báo thành công
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        // Sau khi hiển thị thông báo, chuyển hướng người dùng đến trang đăng nhập
                        window.location.href = response.redirect;
                    });
                } else {
                    // Nếu đăng ký thất bại, hiển thị thông báo lỗi
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error,
                        showConfirmButton: true
                    });
                }
            }
        });
    }

</script>
</body>
</html>
