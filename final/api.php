<?php
header('Content-Type: application/json');

// ตรวจสอบว่ามีการส่งพารามิเตอร์ key หรือไม่
if (isset($_GET['key']) && $_GET['key'] === 'secretKey') {
    // ส่ง flag ในรูปแบบ JSON ถ้าพารามิเตอร์ key ถูกต้อง
    echo json_encode(['flag' => 'CTF{Hidden_Flag_In_API}']);
} else {
    // ส่งข้อความผิดพลาดถ้า key ไม่ถูกต้อง
    echo json_encode(['error' => 'Invalid key']);
}
?>
