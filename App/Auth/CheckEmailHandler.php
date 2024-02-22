<?php

        namespace App\Auth;
        // CheckEmailHandler.php
    use App\Auth\AbstractAuthHandler;
        use App\Models\Customer;
        use App\Repository\CustomerRepository;
        use App\Models\Database;



        class CheckEmailHandler extends AbstractAuthHandler
        {
            private CustomerRepository $customerRepository;

            public function __construct(Database $database)
            {
                $this->customerRepository = new CustomerRepository($database);
            }

            public function handle($customer): bool
            {
                // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
                $emailExists = $this->customerRepository->emailExists($customer->getEmail());

                if (!$emailExists) {
                    echo json_encode(['error' => 'Email chưa được đăng ký.']);
                    return false;
                }

                // Gọi handler tiếp theo trong chuỗi
                return parent::handle($customer);
            }
        }
