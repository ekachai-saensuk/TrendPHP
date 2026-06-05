<?php
// 1. ต้องประกาศคำนี้ที่บรรทัดบนสุดเสมอ เพื่อเปิดใช้งานระบบจำค่า (Session)
session_start();
require_once 'connect.php';

$input_user = $_POST['user'];
$input_pass = $_POST['pass'];

$correct_user = "admin";
$correct_pass = "123456";
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$input_user]);
    
    // ดึงข้อมูลแถวนั้นออกมาเก็บไว้ในตัวแปร $user
    $user = $stmt->fetch(PDO::FETCH_ASSOC); 
    // console_log($user);  
    // echo '<script>console.log(' . json_encode($user) . ');</script>';
    if ($user && password_verify($input_pass, $user['password'])) {
        
        $_SESSION['username'] = $user['username'];
        
        header("Location: dashboard.php");
        exit();
        
    } else {
        // ถ้ารหัสไม่ตรง หรือไม่เจอชื่อผู้ใช้ในระบบ
        echo "<h1>เข้าสู่ระบบล้มเหลว!</h1>";
        echo "<p style='color:red;'>ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง</p>";
        echo "<a href='login.html'>ลองใหม่อีกครั้ง</a>";
    }
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาดในการตรวจสอบข้อมูล: " . $e->getMessage();
}
?>
