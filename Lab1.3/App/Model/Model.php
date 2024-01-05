<?php
function get_user($email){
    include 'config.php';

    // Sử dụng PDO thay vì MySQLi
    $sql = "SELECT * FROM user WHERE email = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $email); // Sử dụng bindParam thay vì bind_param
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Sử dụng fetchAll với PDO
    if (count($result) > 0){
        return $result[0];
    }
}
?>