<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Core\RenderBase;

class UpdatePasswordController extends BaseController
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

    function updatePass()
    {
        $this->updatePassPage();
    }

    function updatePassPage()
    {
        // dữ liệu ở đây lấy từ responsitories hoặc model

//        $this->_renderBase->renderHeader();
        $this->load->render('layouts/client/pages/updatepass');

        $this->_renderBase->renderFooter();
    }

}