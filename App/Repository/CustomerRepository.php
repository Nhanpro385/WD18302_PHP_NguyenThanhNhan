<?php

namespace App\Repository;
use App\Models\Database;
use App\Models\Customer;
class CustomerRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAllCustomers(): array
    {
        $conn = $this->database->connection;
        $sql = "SELECT * FROM customers";
        $result = $conn->query($sql);

        if ($result === false) {
            // Xử lý lỗi, có thể log lỗi hoặc throw exception
            return [];
        }

        $customers = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }
        }

        return $customers;
    }
    public function emailExists(string $email): bool
    {
        // Thực hiện truy vấn kiểm tra email trong cơ sở dữ liệu
        // Trả về true nếu email tồn tại, ngược lại trả về false
        $query = "SELECT COUNT(*) as count FROM customers WHERE email = ?";
        $stmt = $this->database->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }
    public function passCheck($email) {
        // Chuẩn bị truy vấn SQL
        $query = "SELECT password FROM customers WHERE email = ?";
        $stmt = $this->database->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra xem có kết quả từ truy vấn hay không
        if ($result->num_rows > 0) {
            // Lấy mật khẩu từ kết quả truy vấn
            $row = $result->fetch_assoc();
            return $row['password'];
        } else {
            // Trả về null nếu không có kết quả
            return null;
        }
    }
    public function getRoleByEmail(string $email): ?string
    {
        $query = "SELECT role FROM Customers WHERE email = ?";
        $stmt = $this->database->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Trả về vai trò từ cơ sở dữ liệu
            return $row['role'];
        } else {
            return null;
        }
    }
    public function deleteUser(int $customerId): bool
    {
        // Chuẩn bị truy vấn SQL để xóa khách hàng với ID cung cấp
        $query = "DELETE FROM customers WHERE customer_id = ?";
        $stmt = $this->database->connection->prepare($query);
        $stmt->bind_param("i", $customerId);
        $stmt->execute();

        // Kiểm tra xem có bản ghi nào bị ảnh hưởng không
        if ($stmt->affected_rows > 0) {
            // Trả về true nếu xóa thành công
            return true;
        } else {
            // Trả về false nếu không có bản ghi nào bị ảnh hưởng (không xóa được)
            return false;
        }
    }

    public function updatePasswordByEmail(string $email, string $password): bool
    {
        // Chuẩn bị truy vấn SQL để cập nhật mật khẩu
        $query = "UPDATE customers SET password = ? WHERE email = ?";
        $stmt = $this->database->connection->prepare($query);

        $stmt->bind_param("ss", $password, $email);

        // Thực hiện truy vấn để cập nhật mật khẩu
        $success = $stmt->execute();

        // Trả về true nếu cập nhật thành công, ngược lại trả về false
        return $success;
    }
    public function getOTPByEmail(string $email): ?string
    {
        $query = "SELECT otp FROM Customers WHERE email = ?";
        $stmt = $this->database->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Trả về OTP từ cơ sở dữ liệu
            return $row['otp'];
        } else {
            return null;
        }
    }

    public function getUserByEmail(string $email): ?array
    {
        $query = "SELECT * FROM Customers WHERE email = ?";
        $stmt = $this->database->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Trả về mảng kết quả từ cơ sở dữ liệu
            return $row;
        } else {
            return null;
        }
    }
    public function register(array $userData): bool
    {
        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        if ($this->emailExists($userData['email'])) {
            // Email đã tồn tại, không thể đăng ký
            return false;
        }


        // Tạo mới đối tượng Customer và thiết lập dữ liệu từ mảng đầu vào
        $customer = new Customer();
        $customer->setDataFromArray($userData);


        // Tạo các biến trung gian để lưu giá trị của thuộc tính
        $customerName = $customer->getCustomerName();

        $email = $customer->getEmail();
        $password = $customer->getPassword();
        $role = $customer->getRole();
        $phone = $customer->getPhone();
        $address=$customer->getAddress();
       // Thực hiện truy vấn để chèn dữ liệu vào cơ sở dữ liệu
        $query = "INSERT INTO customers (customer_name, email, password, role, phone_number,address) VALUES (?,?, ?, ?, ?, ?)";
        $stmt = $this->database->connection->prepare($query);

        // Sử dụng các biến trung gian trong bind_param
        $stmt->bind_param("ssssss", $customerName, $email, $password, $role, $phone,$address);

        // Thực hiện truy vấn
        $success = $stmt->execute();

        // Trả về true nếu đăng ký thành công, ngược lại trả về false
        return $success;
    }
    public function updateUserById(int $customerId, array $userData): bool
    {
        // Kiểm tra xem ID của khách hàng có tồn tại không
        $query = "SELECT * FROM customers WHERE customer_id = ?";
        $stmt = $this->database->connection->prepare($query);
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Không tìm thấy khách hàng với ID cung cấp
            return false;
        }

        // Tiếp tục với logic cập nhật dữ liệu của khách hàng
        $query = "UPDATE customers SET customer_name = ?, email = ?, address = ?, phone_number = ? WHERE customer_id = ?";
        $stmt = $this->database->connection->prepare($query);
        $stmt->bind_param("ssssi", $userData['customer_name'], $userData['email'], $userData['address'], $userData['phone_number'], $customerId);
        $success = $stmt->execute();

        // Trả về true nếu cập nhật thành công, ngược lại trả về false
        return $success;
    }
    public function updateOTPByEmail(string $email, string $otp): bool
    {
        // Chuẩn bị truy vấn SQL để cập nhật mã OTP cho email tương ứng
        $query = "UPDATE customers SET otp = ? WHERE email = ?";
        $stmt = $this->database->connection->prepare($query);
        $stmt->bind_param("ss", $otp, $email);
        $success = $stmt->execute();

        // Trả về true nếu cập nhật thành công, ngược lại trả về false
        return $success;
    }


}