<?php

namespace App\Controllers;

use App\Core\RenderBase;

class HomeController extends BaseController
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

    function HomeController()
    {
        $this->homePage();
    }

    function homePage()
    {
        // dữ liệu ở đây lấy từ responsitories hoặc model

// Kiểm tra xem session đã tồn tại hay không
if (!isset($_SESSION['customer'])) {
    // Nếu có phiên đăng nhập, chuyển hướng người dùng đến trang chính đã đăng nhập
    $this->load->render('layouts/client/pages/login');

    $this->_renderBase->renderFooter(); // Đảm bảo không có mã HTML hoặc mã PHP nào được thực thi sau khi chuyển hướng
} else {
    // Nếu không có phiên đăng nhập, hiển thị trang home sản phẩm
    $this->_renderBase->renderHeader();
    $this->load->render('layouts/client/home_product');
    $this->_renderBase->renderFooter();
}


    }

    function detail($id)
    {        // dữ liệu ở đây lấy từ responsitories hoặc model
      
    }

}