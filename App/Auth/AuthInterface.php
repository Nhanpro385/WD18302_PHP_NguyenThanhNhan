<?php

namespace App\Auth;

use App\Model\Customer;

interface AuthInterface
{
    public function setNext(AuthInterface $handler): AuthInterface;
    public function handle(Customer $customer): bool;
}
