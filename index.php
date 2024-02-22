<?php
session_start();
require_once "vendor/autoload.php";

const ROOT_URL = "127.0.0.1:3306";
use App\Controllers\BaseController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Database;
use App\Core\Route;
use App\Repository\CustomerRepository;
use App\Auth\CheckEmailHandler;
use App\Models\Customer;
use App\Auth\CheckPasswordHandler;
use App\Controllers\RegisterController;
use App\Auth\CheckRoleHandler;

new Route;






