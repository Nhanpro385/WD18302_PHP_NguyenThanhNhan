<?php
namespace App\Model;
  class Address extends Product{
    private $_nameReceiver="Thanh Nhan";
    private $_phoneNumberReceiver='0787515787';
    private $_Address='can tho city';



    
public function getNameReciver(){
    return $this->_nameReceiver;
}
public function getPhoneNumberReciver(){
    return $this->_phoneNumberReceiver;
}
public function getAddress(){
    return $this->_Address;
}


  }

?>