<?php

namespace App\Controllers;
use App\Core\Render;


use App\Helpers\Message;
use App\Core\RenderBase;
use App\Repository\CustomerRepository;
use App\Auth\CheckEmailHandler;
use App\Models\Customer;
use App\Auth\CheckPasswordHandler;
use App\Auth\Validation;
use App\Auth\CheckRoleHandler;
use App\Controllers\BaseController;

class RegisterController extends BaseController
{


    private $_renderBase;
    public function __construct()
    {
        parent::__construct();
        $this->_renderBase = new RenderBase();
    }

   public function registerController()
    {
        $this->registerPage();
    }

   public function registerPage()
    {
        // dữ liệu ở đây lấy từ responsitories hoặc model

//        $message = new Message();
//        // Chuyển nội dung của biến $message thành một mảng
//        $data = ['message' => $message->getContent()];
        //        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/register');

        $this->_renderBase->renderFooter();
    }

  public function handleRegister()
    {
        // Kiểm tra nếu yêu cầu không phải là AJAX, trả về lỗi
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Yêu cầu không hợp lệ.']);
            return;
        }

        // Khởi tạo một mảng kết quả
        $response = [];

        // Kiểm tra nếu dữ liệu đã được gửi từ form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword=$_POST['confirm_password'];


            $address = $_POST['address'];
            $phone = $_POST['phone'];

            // Validate dữ liệu đăng ký
            $validation = new Validation();
            $name = $validation->trimValue($name);
            $email = $validation->trimValue($email);
            $password = $validation->trimValue($password);
            $confirmPassword=$validation->trimValue($confirmPassword);
            $address = $validation->trimValue($address);
            $phone = $validation->trimValue($phone);

            // Mảng lưu trữ các thông báo lỗi
            $errorMessages = [];
            if ($validation->emailExist($email)) {
                $errorMessages[] = "Tài khoản đã tồn tại.";
            }

            if (!$validation->lengthValue($name, 1, 255)) {
                $errorMessages[] = "Tên không hợp lệ.";
            }

            if (!$validation->lengthValue($password, 6, 255)) {
                $errorMessages[] = "Mật khẩu cần có độ dài lớn hơn 6 ký tự.";
            }
            if (!$validation->confirmPassword($password, $confirmPassword)) {
                $errorMessages[]="Mật khẩu xác nhận không trùng khớp";
            }

            // Kiểm tra xem có lỗi nào đó
            if (!empty($errorMessages)) {
                // Gán thông báo lỗi vào phần tử 'error' của mảng kết quả
                $response['error'] = implode(" ,", $errorMessages);
            } else {
                $customer = new Customer();
                // Khởi tạo một đối tượng CustomerRepository
                $customerRepository = new CustomerRepository($customer->getConn());

                // Thực hiện đăng ký tài khoản
                $success = $customerRepository->register([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'address' => $address,
                    'phone' => $phone,
                    'role' => 'customer' // Giả sử mặc định là khách hàng
                ]);

                if ($success) {
                    // Gán thông báo thành công vào phần tử 'success' của mảng kết quả
                    $response['success'] = "Đăng ký tài khoản thành công.";
                    // Chuyển hướng người dùng đến trang đăng nhập
                    $response['redirect'] = '?url=LoginController/loginPage';
                } else {
                    // Gán thông báo lỗi vào phần tử 'error' của mảng kết quả
                    $response['error'] = "Đăng ký tài khoản thất bại.";
                }
            }
        } else {
            // Không có dữ liệu POST, không có lỗi
            $response['error'] = "";
        }

        // Trả về phản hồi dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}   