<?php
namespace App\Core;
use App\Reponsitories\Modelinterface;
use App\Reponsitories\AbstractClass;
class Base extends AbstractClass implements Modelinterface{
    const VERSION = 12.2;
    private $_name='PHP';

    public function getName(){
        return $this->_name;
    }
public function setName($language){
    echo self::VERSION,'<br>';
$this->_name = $language;
}

public function getAbstractModel(){
    echo "hi";
}
public function getAll(){

}








}