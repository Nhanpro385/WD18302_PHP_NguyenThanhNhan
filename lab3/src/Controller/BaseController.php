<?php
namespace App\Controller;
Class BaseController{
    public $namefile='Controller.php';
    public function __construct(){
        echo $this->namefile;
    }
};

?>