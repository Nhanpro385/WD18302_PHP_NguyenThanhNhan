<?php

namespace App\Controllers;

use App\Auth\Validation;
use App\Controllers\BaseController;
use App\Core\RenderBase;
use App\Repository\CustomerRepository;
use App\Auth\CheckEmailHandler;
use App\Models\Customer;
use App\Auth\CheckPasswordHandler;

use App\Auth\CheckRoleHandler;
class LoginController extends BaseController
{

    private $_renderBase;

    /**
     * Thuốc trị đau lưng
     * Copy lại là hết đau lưng
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->_renderBase = new RenderBase();
    }

    function LoginController()
    {
        $this->loginPage();
    }

    function loginPage()
    {
        // dữ liệu ở đây lấy từ responsitories hoặc model


//        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/login');

        $this->_renderBase->renderFooter();
    }

    public function handleLogin()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            // Khởi tạo một mảng kết quả
            $response = [];

            // Kiểm tra xem dữ liệu đã được gửi từ form chưa
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Lấy dữ liệu từ form
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Khởi tạo đối tượng Validation
                $validation = new Validation();

                // Kiểm tra định dạng email và tồn tại trong cơ sở dữ liệu
                if (!$validation->lengthValue($email, 5, 50)) {
                    $response['error'] = "Địa chỉ email phải có từ 5 đến 50 ký tự.";
                } elseif (!$validation->emailExist($email)) {
                    $response['error'] = "Email chưa được đăng ký.";
                } elseif (!$validation->checkPass($email,$password)) {
                    $response['error'] = "Mật khẩu sai";
                }elseif ($validation->checkRole($email)!='admin'){
                    $response['error']='Bạn không có quyền truy cập';
                } else {
                    // Xử lý đăng nhập thành công
                    $_SESSION['customer'] = ['email' => $email]; // Lưu thông tin người dùng vào session
                    $response['success'] = "Đăng nhập thành công.";
                    $response['redirect'] = '?url='; // Chuyển hướng người dùng sau khi đăng nhập thành công
                }
            } else {
                // Yêu cầu không hợp lệ
                $response['error'] = "Yêu cầu không hợp lệ.";
            }

            // Trả về phản hồi dưới dạng JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // Yêu cầu không phải là AJAX, trả về lỗi
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Yêu cầu không hợp lệ.']);
        }
    }

    public function logout()
    {
        $_SESSION = [];

        // Hủy bỏ cookie lưu session id nếu có
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }

        // Hủy bỏ session
        session_destroy();

        // Chuyển hướng người dùng đến trang đăng nhập
        $this->redirect('?url=LoginController/loginPage');
        exit;
    }
}
