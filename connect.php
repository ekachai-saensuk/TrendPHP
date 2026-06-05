<?php
$host = "localhost";
$username = "root";  // ค่าเริ่มต้นของ XAMPP
$password = "";      // ค่าเริ่มต้นของ XAMPP จะว่างไว้
$dbname = "test";

try {
    // เชื่อมต่อด้วยระบบ PDO เป็นมาตรฐานที่ปลอดภัยที่สุดในปัจจุบัน
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "เชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
    exit();
}
?>
