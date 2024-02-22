<?php

    namespace App\Controllers;
    use App\Repository\CustomerRepository;
    use App\Models\Database;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    class AjaxController
    {
        protected $customerRepository;
        private $database;
        public function __Construct(){
            $this->database = new Database();
            $this->customerRepository = new CustomerRepository($this->database);
        }
        public function handleAjaxRequest()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'getAllUsers':
                        // Kiểm tra xem trường "view" có tồn tại không
                        $viewData = isset($_POST['view']) ? $_POST['view'] : '';

                        $this->getAllUsers($viewData);
                        break;
                    case 'updateUser':
                        // Kiểm tra xem các trường dữ liệu cần thiết đã được gửi lên không
                        if (isset($_POST['customerId'], $_POST['customerName'], $_POST['customerEmail'], $_POST['customerAddress'], $_POST['customerPhoneNumber'])) {
                            $customerId = $_POST['customerId'];
                            $customerName = $_POST['customerName'];
                            $customerEmail = $_POST['customerEmail'];
                            $customerAddress = $_POST['customerAddress'];
                            $customerPhoneNumber = $_POST['customerPhoneNumber'];

                            // Tạo mảng dữ liệu từ các thông tin được gửi dưới dạng POST
                            $customerData = [
                                'customer_name' => $customerName,
                                'email' => $customerEmail,
                                'address' => $customerAddress,
                                'phone_number' => $customerPhoneNumber
                            ];

                            // Cập nhật thông tin của khách hàng trong cơ sở dữ liệu
                            $success = $this->customerRepository->updateUserById($customerId, $customerData);

                            // Trả về kết quả cập nhật
                            echo json_encode(['success' => $success]);
                        } else {
                            // Nếu thiếu dữ liệu cần thiết, trả về thông báo lỗi
                            echo json_encode(['error' => 'Missing required data']);
                        }
                        break;

                }
            } else {
                $this->respondError('Invalid request');
            }
        }
        public function handleUpdateUserRequest()
        {
            // Kiểm tra xem các trường dữ liệu cần thiết đã được gửi lên không
            if (isset($_POST['customerId'], $_POST['customerName'], $_POST['customerEmail'], $_POST['customerAddress'], $_POST['customerPhoneNumber'])) {
                $customerId = $_POST['customerId'];
                $customerName = $_POST['customerName'];
                $customerEmail = $_POST['customerEmail'];
                $customerAddress = $_POST['customerAddress'];
                $customerPhoneNumber = $_POST['customerPhoneNumber'];

                // Tạo mảng dữ liệu từ các thông tin được gửi dưới dạng POST
                $customerData = [
                    'customer_name' => $customerName,
                    'email' => $customerEmail,
                    'address' => $customerAddress,
                    'phone_number' => $customerPhoneNumber
                ];

                // Cập nhật thông tin của khách hàng trong cơ sở dữ liệu
                $success = $this->customerRepository->updateUserById($customerId, $customerData);

                // Trả về kết quả cập nhật
                echo json_encode(['success' => $success]);
            } else {
                // Nếu thiếu dữ liệu cần thiết, trả về thông báo lỗi
                echo json_encode(['error' => 'Missing required data']);
            }
        }
        public function handleForgotPasss()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
                $email = $_POST['email'];

                // Kiểm tra xem email tồn tại trong cơ sở dữ liệu hay không
                if ($this->customerRepository->emailExists($email)) {
                    // Tạo mã OTP
                    $otp = $this->generateOTP();

                    // Lưu mã OTP vào cơ sở dữ liệu cho email tương ứng
                    $this->customerRepository->updateOTPByEmail($email, $otp);

                    // Gửi email chứa mã OTP
                    $this->sendOTPEmail($email, $otp);
                    setcookie("EmailForgot", $email, time()+3600);

                    // Trả về kết quả thành công
                    echo json_encode(['success' => true]);
                } else {
                    // Email không tồn tại trong cơ sở dữ liệu
                    echo json_encode(['error' => 'Email không tồn tại trong hệ thống']);
                }
            } else {
                // Yêu cầu không hợp lệ
                echo json_encode(['error' => 'Yêu cầu không hợp lệ']);
            }
        }

        private function generateOTP(): string
        {
            // Tạo mã OTP ngẫu nhiên, ví dụ: 6 chữ số
            return strval(mt_rand(100000, 999999));
        }

        private function sendOTPEmail(string $email, string $otp)
        {
            // Khởi tạo PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'nhan82792@gmail.com';
                $mail->Password = 'awmprakctuhymkji';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Địa chỉ người gửi
                $mail->setFrom('nhan82792@gmail.com', 'Reset password');

                // Địa chỉ người nhận
                $mail->addAddress($email);

                // Tiêu đề email
                $mail->Subject = 'Mã OTP để khôi phục mật khẩu';

                // Nội dung email
                $mail->isHTML(true);

// Thiết lập nội dung của email bằng HTML
                $mail->Body = "<p>Mã OTP của bạn là: $otp</p>";

                // Gửi email
                $mail->send();
            } catch (Exception $e) {
                // Xử lý nếu gặp lỗi khi gửi email
                echo json_encode(['error' => 'Lỗi khi gửi email: ' . $mail->ErrorInfo]);
            }
        }
        public function hanldeOTP(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['OTP'])) {
                $OTP = $_POST['OTP'];
                $Email=$_COOKIE['EmailForgot'];

               if($OTP ==$this->customerRepository->getOTPByEmail($Email)){
                   echo json_encode(['success' => true]);
               } else {
                   // Email không tồn tại trong cơ sở dữ liệu
                   echo json_encode(['error' => 'OTP không Chính xác']);
               }


            }else {
                // Yêu cầu không hợp lệ
                echo json_encode(['error' => 'Yêu cầu không hợp lệ']);
            }
        }
        public function handleDeleteUserRequest()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customerId'])) {
                // Lấy customerId từ dữ liệu POST
                $customerId = $_POST['customerId'];

                // Kiểm tra xem customerId có tồn tại không
                if (!empty($customerId)) {
                    // Gọi hàm trong CustomerRepository để xóa khách hàng
                    $success = $this->customerRepository->deleteUser($customerId);

                    if ($success) {
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['success' => false, 'error' => 'Xóa khách hàng không thành công.']);
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'Thiếu ID của khách hàng.']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Yêu cầu không hợp lệ.']);
            }
        }

        public function handlerUpdatePass(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['OTP'])) {
                $OTP = $_POST['OTP'];
                $Email=$_COOKIE['EmailForgot'];

                if($OTP ==$this->customerRepository->getOTPByEmail($Email)){
                    echo json_encode(['success' => true]);
                } else {
                    // Email không tồn tại trong cơ sở dữ liệu
                    echo json_encode(['error' => 'OTP không Chính xác']);
                }


            }else {
                // Yêu cầu không hợp lệ
                echo json_encode(['error' => 'Yêu cầu không hợp lệ']);
            }
        }

        public function handleUpdatePasswordRequest()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'], $_POST['confirmPassword'])) {
                $email = $_COOKIE['EmailForgot'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];

                // Kiểm tra xác thực OTP ở đây (có thể làm bằng CustomerRepository hoặc bất kỳ phương pháp nào khác)

                // Kiểm tra xem mật khẩu mới và xác nhận mật khẩu có khớp không
                if ($password !== $confirmPassword) {
                    echo json_encode(['error' => 'Mật khẩu và xác nhận mật khẩu không khớp']);
                    return;
                }

                // Gọi hàm trong CustomerRepository để cập nhật mật khẩu
                $success = $this->customerRepository->updatePasswordByEmail($email, $password);

                if ($success) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['error' => 'Cập nhật mật khẩu thất bại']);
                }
            } else {
                // Nếu thiếu dữ liệu cần thiết, trả về thông báo lỗi
                echo json_encode(['error' => 'Thiếu dữ liệu cần thiết']);
            }
        }




        public function getAllUsers() {
            $responseData = [
                'users' => $this->customerRepository->getAllCustomers()
            ];

            $this->respondJson($responseData);
        }
        public function respondJson($data)
        {
            header('Content-Type: application/json');
            echo json_encode($data);
            exit;
        }


        public function respondError($message)
        {
            $responseData = [
                'error' => $message
            ];
            $this->respondJson($responseData);
        }
    }