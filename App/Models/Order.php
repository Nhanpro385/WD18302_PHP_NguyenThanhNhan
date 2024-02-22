<?php
namespace App\Model;


class Order extends Address{
    private $_order_id='23424';
    private $_Status='pending';
    private $_paymentMethod="credit";
    private $_into_money="2364626462";


    public function getOrder_id() {
        return $this->_order_id;
    }
    public function getStatus() {
        return $this->_Status;
    }
    public function paymentMethod() {
        return $this->_paymentMethod;
    }
    public function getinto_money() {
        
        return $this->_into_money;
    }
}