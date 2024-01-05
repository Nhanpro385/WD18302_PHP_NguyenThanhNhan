<?php
function get_orders(){
    include 'config.php';

    // Sử dụng PDO thay vì MySQLi
    $sql = "SELECT * FROM `orders`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($result) > 0) {
        return $result;
    }
    
}
?>