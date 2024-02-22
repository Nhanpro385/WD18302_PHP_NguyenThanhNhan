<?php
namespace App\Model;
  class Address extends Product{
    private $_OrderItemId="Thanh Nhan";
    private $_OrderId='0787515787';
    private $_ProductId='can tho city';

private $_quantity;
private $_subtotal;

    
public function GetOrderItemId(){
    return $this->_OrderItemId;
}
public function GetOrderId(){
    return $this->_OrderId;
}
public function GetProductId(){
    return $this->_ProductId;
}
public function Getquantity(){
  return $this->_quantity;
}
public function Getsubtotal(){
  return $this->_subtotal;
}

  }

?>