<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call External Function</title>
</head>
<body>

    
    <!-- รวมไฟล์ JavaScript ภายนอก -->
    <script src="test.js"></script>
    
    <button onclick="callExternalFunction()">Click me</button>
    <script>
        // ฟังก์ชันที่จะถูกเรียกใช้เมื่อคลิกปุ่ม
        function callExternalFunction() {
            // เรียกใช้ฟังก์ชันจาก hidden.js
            showAlert('Hello from external function!');
        }
    </script>

</body>
</html>
