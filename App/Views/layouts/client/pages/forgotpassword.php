<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha1/css/bootstrap.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Quên mật khẩu</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Vui lòng nhập địa chỉ email của bạn để khôi phục mật khẩu.</p>
            <form id="forgotPasswordForm">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Gửi yêu cầu</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.min.js" integrity="sha512-btI66ve7fQgZDNoDwW+Xk4rFFop6e4dCwczgWp5vRcZT/A3DgLEbF8xP5UX/3oUsr6VtMlmX4g9rW9gnU6IVbg==" crossorigin="anonymous" defer></script>

<!-- Your custom scripts -->
<script>
    // Đoạn mã JavaScript
    $(document).ready(function() {
        // Bắt sự kiện submit của form
        $('#forgotPasswordForm').submit(function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của form

            // Lấy dữ liệu từ form
            var formData = $(this).serialize();

            // Thực hiện AJAX request
            $.ajax({
                type: 'POST',
                url: '?url=AjaxController/handleForgotPasss',
                data: formData,
                success: function(response) {
                    // Xử lý kết quả trả về
                    if (response.success) {
                        // Hiển thị thông báo thành công
                        Swal.fire({
                            icon: 'error',
                            title: 'Đã xảy ra lỗi 1!',
                            text: response.error,

                        });
                    } else {
                        // Hiển thị thông báo lỗi
                        Swal.fire({

                            icon: 'success',
                            title: 'Yêu cầu đã được gửi thành công!',
                            text: 'Vui lòng kiểm tra email của bạn để khôi phục mật khẩu.',
                            didClose: () => {
                                // Chuyển hướng đến đường link mong muốn
                                window.location.href = '?url=ConfirmOTPController/ConfirmOTP';
                            }

                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu có
                    Swal.fire({
                        icon: 'error',
                        title: 'Đã xảy ra lỗi 2!',
                        text: 'Có lỗi xảy ra trong quá trình xử lý yêu cầu. Vui lòng thử lại sau.',
                    });
                }
            });
        });
    });





</script>
</body>
</html>
