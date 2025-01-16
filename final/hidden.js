// ฟังก์ชันที่อยู่ในไฟล์ JavaScript ภายนอก
function getFlag() {
    fetch('api.php?key=secretKey')  // ส่งคำขอ GET ไปยัง API
        .then(response => response.json())
        .then(data => {
            if (data.flag) {
                alert('Flag: ' + data.flag);  // แสดง flag ที่ได้รับจาก API
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error fetching flag:', error);
        });
}