<?php
// Cấu hình kết nối Database
$host = "localhost";
$db_name = "buoi2_php";
$username = "root";
$password = "";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$db_name;charset=utf8",
        $username,
        $password
    );
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
} catch (PDOException $e) {
    echo "❌ Hệ thống đang bảo trì, vui lòng quay lại sau<br><br>";
    echo "Chi tiết lỗi: " . htmlspecialchars($e->getMessage());
    exit();
}
?>
