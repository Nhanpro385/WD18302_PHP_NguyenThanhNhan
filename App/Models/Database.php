<?php



namespace App\Models;
use mysqli;

class Database{
private static string $dbHost = 'localhost';
private static string $username='root';
private static string $password='';
private static string $dbPort ='3306';
private static string $dbName ='asmphp2';

public mysqli $connection;



public function __construct(){
    self::mySQLi();

}



    public function mySQLi(): void
    {
        $conn = new mysqli(self::$dbHost, self::$username, self::$password, self::$dbName, self::$dbPort);

        if($conn->connect_error){
    die("connection failed :".$conn->connect_error);

}
$this->connection=$conn;
    }
    public function connectPDO(): void
    {
        $dsn = "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName . ";port=" . self::$dbPort;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->connection = new PDO($dsn, self::$username, self::$password, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    public function create(string $table, array $data): bool
    {
        $keys = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $placeholders = str_repeat('?,', count($data) - 1) . '?'; // Tạo chuỗi ? tương ứng với số lượng giá trị

        $query = "INSERT INTO $table ($keys) VALUES ($placeholders)";

        $types = str_repeat('s', count($data)); // Giả sử tất cả các giá trị là kiểu string (s)
        $params = array_merge([$types], array_values($data)); // Ghép loại dữ liệu với giá trị dữ liệu

        $stmt = $this->connection->prepare($query);
        if ($stmt) {
            $stmt->bind_param($types, ...$params); // Sử dụng unpacking để truyền mảng vào bind_param
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } else {
            return false;
        }
    }



    public function read($tableName)
    {
        $query = "SELECT * FROM $tableName";
        $result = $this->connection->query($query);
        return $result;
    }

    // Phương thức cập nhật dữ liệu trong bảng
    public function update($tableName, $data, $id)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');

        $query = "UPDATE $tableName SET $set WHERE id = $id";
        $result = $this->connection->query($query);
        return $result;
    }

    // Phương thức xóa dữ liệu trong bảng
    public function delete($tableName, $id)
    {
        $query = "DELETE FROM $tableName WHERE id = $id";
        $result = $this->connection->query($query);
        return $result;
    }


    protected function getConn(){
    return $this->connection;
}

}