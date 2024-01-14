<?php
namespace App\Model;
class Product {
    private $_name = 'Product';
    private $_price = '2031';
    private $_description = 'best seller product description';




    public function getNameProduct() {
        return $this->_name;
    }
    public function getPrice() {
return $this->_price;

    }
    public function getDescription() {
        return $this->_description;
    }
    public function setNameProduct($name) {
        $this->_name = $name;
    }
    public function setPrice($price) {
        $this->_price = $price;
    }
public function setDescription($description) {
    $this ->_description = $description;
}
}