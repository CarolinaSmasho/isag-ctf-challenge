<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple CTF</title>
</head>
<body>
    <h1>ยินดีต้อนรับสู่ CTF Challenge</h1>
    <p>กรุณาแสดงความคิดเห็นของคุณ</p>
    <form method="POST">
        <input type="text" name="comment" placeholder="เขียนความคิดเห็นที่นี่" required>
        <button type="submit">ส่งความคิดเห็น</button>
    </form>
    <h2>Comments</h2>
    <div id="comments">
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $comment = htmlspecialchars($_POST["comment"]);
            echo "<p>$comment</p>";
        }
        ?>
    </div>
    <!-- Flag is: ISAG_CTF{source_code_master} -->
</body>
</html>
