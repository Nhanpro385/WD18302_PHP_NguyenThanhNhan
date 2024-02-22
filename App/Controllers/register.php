<?php


require_once '../../vendor/autoload.php'; // Đảm bảo rằng bạn đã bao gồm autoload của Composer

use App\Controllers\RegisterController;

$controller = new RegisterController();
$controller->handleRegister();
