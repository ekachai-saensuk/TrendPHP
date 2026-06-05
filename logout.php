<?php
session_start();

// ล้างค่าเซสชันทั้งหมดทิ้งเพื่อความปลอดภัย
session_destroy();

// เด้งกลับไปหน้าล็อกอินเดิม
header("Location: login.html");
exit();
?>
