<?php
namespace App\Auth;
use App\Models\Customer;

abstract class AbstractAuthHandler implements AuthInterface
{
    private ?AuthInterface $nextHandler = null;

        public function setNext(AuthInterface $handler): AuthInterface
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle( $customer): bool
    {
        if ($this->nextHandler !== null) {
            return $this->nextHandler->handle($customer);
        }

        return true; // Hành vi mặc định nếu không có handler nào xử lý yêu cầu
    }
}
