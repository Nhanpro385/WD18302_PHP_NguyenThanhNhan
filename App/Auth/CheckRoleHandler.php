<?php
namespace App\Auth;

use App\Models\Customer;

class CheckRoleHandler extends AbstractAuthHandler
{
    public function handle($customer): bool
    {
        $customer->setRole( $this->customerRepository->getRoleByEmail($customer->getEmail()));
        // Kiểm tra vai trò của người dùng
        if ($customer->getRole() !== 'admin') {

            echo json_encode(['error' => 'Bạn không có quyền truy cập.']);
            return false;
        }

        // Gọi handler tiếp theo trong chuỗi
        return parent::handle($customer);
    }
}