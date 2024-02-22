<?php

namespace App\Models;
use App\Models\BaseModel;
class Customer extends BaseModel
{
    private $customer_id;
    private $customer_name;
    private $password;

    /**
     * @return mixed
     */

    private $email;
    private $address;
    private $phone;
    private $role;

    public function getConn(){
        return $this->connection;
    }
    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    public function getCustomerName(): ?string
    {
        return $this->customer_name;
    }
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function setCustomerName(string $customer_name): void
    {
        $this->customer_name = $customer_name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function deleteOne(int $id)
    {
        // TODO: Implement deleteOne() method.
    }

    public function updateOne(int $id, array $data)
    {
        // TODO: Implement updateOne() method.
    }
    public function setDataFromArray(array $data): void
    {

        if (isset($data['name'])) {
            $this->setCustomerName($data['name']);
        }
        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }
        if (isset($data['password'])) {
            $this->setPassword($data['password']);
        }
        if (isset($data['address'])) {
            $this->setAddress($data['address']);
        }
        $role = isset($data['role']) && $data['role'] !== '' ? $data['role'] : 'customer';
        $this->setRole($role);
        if (isset($data['phone'])) {
            $this->setPhone($data['phone']);
        }
        // Tiếp tục với các trường dữ liệu khác tương tự
    }
    public function toArray(): array
    {
        return [
            'customer_id' => $this->getCustomerId(),
            'customer_name' => $this->getCustomerName(),
            'email' => $this->getEmail(),
            'role' => $this->getRole(),
            'phone_number' => $this->getPhone()
        ];
    }

}
