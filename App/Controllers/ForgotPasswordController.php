<?php

namespace App\Controllers;


use App\Auth\Validation;
use App\Controllers\BaseController;
use App\Core\RenderBase;
use App\Repository\CustomerRepository;
use App\Auth\CheckEmailHandler;
use App\Models\Customer;
use App\Auth\CheckPasswordHandler;

class ForgotPasswordController extends BaseController
{

    private $_renderBase;

    /**
     * Thuốc trị đau lưng
     * Copy lại là hết đau lưng
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->_renderBase = new RenderBase();
    }

    function ForgotPasswordController()
    {
        $this->ForgotPage();
    }

    function forgotPage()
    {
        // dữ liệu ở đây lấy từ responsitories hoặc model


//        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/forgotpassword');

        $this->_renderBase->renderFooter();
    }

    public function handlerForgot(){

    }



}