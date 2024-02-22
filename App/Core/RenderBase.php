<?php

namespace App\Core;

use App\Controllers\BaseController;

class RenderBase extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function renderHeader(){
        $this->load->render('layouts/client/header');
    }

    public function renderFooter(){
        $this->load->render('layouts/client/footer');
    }
}