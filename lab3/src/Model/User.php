<?php
namespace App\Model;
Class User{
    private $username="nhandeptrai";
    private $password;
    private $fullname;
    public function getUserName(){
        return $this->username;
    }
    public function setFullName($fullname){
        $this->fullname = $fullname;
    }
    public function getPassword(){
return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function getFullName(){
        return $this->fullname;
    }
}