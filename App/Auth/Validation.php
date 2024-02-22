<?php

namespace App\Auth;

use App\Repository\CustomerRepository;
use App\Models\Customer;
class Validation
{
    private CustomerRepository $customerRepository;





    public function trimValue($dataInput)
    {
        // Xóa các khoảng trắng ở đầu và cuối chuỗi
        return trim($dataInput);
    }

    public function lengthValue($dataInput, $minLength, $maxLength)
    {
        // Kiểm tra độ dài của chuỗi
        $length = strlen($dataInput);
        return $length >= $minLength && $length <= $maxLength;
    }

    public function emailExist($emailInput)
    {
        // Thực hiện kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        // Ví dụ sử dụng một Repository để truy vấn cơ sở dữ liệu và kiểm tra email
        $database=new Customer();
        $userRepository = new CustomerRepository($database->getConn()); // Giả sử UserRepository là class thực hiện truy vấn cơ sở dữ liệu
        return $userRepository->emailExists($emailInput);
    }
    public function confirmPassword(string $password, string $confirmPassword): bool
    {
        // Kiểm tra xem mật khẩu và mật khẩu xác nhận có khớp nhau không
        return $password === $confirmPassword;
    }

    public function isNum($dataInput){
        return is_numeric($dataInput);
}

    public function passwordCheck($passwordInput)
    {
        // Kiểm tra mật khẩu có đáp ứng yêu cầu (ví dụ: độ dài, ký tự đặc biệt, số, chữ) không
        // Ví dụ đơn giản: mật khẩu có ít nhất 6 ký tự
        return strlen($passwordInput) >= 6;
    }
 public function checkPass($emailInput,$passInput){
     $database=new Customer();
     $userRepository = new CustomerRepository($database->getConn()); // Giả sử UserRepository là class thực hiện truy vấn cơ sở dữ liệu
    return $passInput==$userRepository->passCheck($emailInput);
 }
 public function checkRole($emailInput){
     $database=new Customer();
     $userRepository = new CustomerRepository($database->getConn()); // Giả sử UserRepository là class thực hiện truy vấn cơ sở dữ liệu
     return $userRepository->getRoleByEmail($emailInput);
 }
}