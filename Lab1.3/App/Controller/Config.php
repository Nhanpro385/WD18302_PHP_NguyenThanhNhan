<?php
$dburl = "mysql:host=localhost;dbname=lab1.3;charset=utf8";
$username = "root";
$password = "";
try {
    $conn = new PDO($dburl, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "ket noi thanh cong";
} catch (PDOException $e) {
    echo "ket noi that bai" . $e->getMessage();
}
function pdo_get_connection()
{
    $dburl =  "mysql:host=localhost;dbname=lab1.3;charset=utf8";
    $username = "root";
    $password = "";
    $conn = new PDO($dburl, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
?>