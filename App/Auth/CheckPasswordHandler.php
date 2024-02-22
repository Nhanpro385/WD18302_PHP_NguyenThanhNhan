<?php
// CheckPasswordHandler.php
namespace App\Auth;

use App\Auth\AbstractAuthHandler;
use App\Models\Customer;
use App\Repository\CustomerRepository;
use App\Models\Database;
class CheckPasswordHandler extends AbstractAuthHandler
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle($customer): bool
    {
        // Kiểm tra mật khẩu của người dùng
        if ($customer->getPassword() !== $this->getProvidedPassword($customer)) {
            // Trả về false nếu mật khẩu không đúng
            echo json_encode(['error' => 'Sai mật khẩu.']);
            return false;
        }

        // Gọi handler tiếp theo trong chuỗi
        return parent::handle($customer);
    }

    private function getProvidedPassword(Customer $customer): string
    {
        // Lấy mật khẩu từ cơ sở dữ liệu
        return $this->customerRepository->passCheck($customer->getEmail());
    }
}