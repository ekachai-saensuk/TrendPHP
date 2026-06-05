<?php
// 1. ดึงไฟล์เชื่อมต่อฐานข้อมูลเข้ามาใช้งาน
require_once 'connect.php';

// 2. รับค่าจากฟอร์ม
$input_user = $_POST['user'];
$input_email = $_POST['email'];
$input_pass = $_POST['pass'];

// 3. เข้ารหัสผ่านด้วยฟังก์ชัน password_hash (ระบบจะแปลงรหัสให้ยาวๆ เดายาก เป็นมาตรฐานสากล)
$secure_pass = password_hash($input_pass, PASSWORD_DEFAULT);

try {
    // 4. เตรียมคำสั่ง SQL สำหรับเตรียมเพิ่มข้อมูล (ใช้เครื่องหมาย ? เพื่อป้องกัน SQL Injection)
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    
    // 5. ส่งข้อมูลจริงเข้าไปแทนที่เครื่องหมาย ? และสั่งประมวลผล
    $stmt->execute([$input_user, $input_email, $secure_pass]);
    
    echo "<h1>สมัครสมาชิกสำเร็จแล้ว!</h1>";
    echo "<a href='login.html'>คลิกที่นี่เพื่อไปหน้าล็อกอิน</a>";

} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาดในการสมัครสมาชิก: " . $e->getMessage();
}
?>
