<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comment System</title>
    <script>
        var a = 'ISAG_CTF{';
        var b = 'Yaerin_';
        var c = 'was_taken}';
        </script>
        <div id="flag" data-flag="ISAG_CTF{ํYaerin_was_taken}"></div>
</head>
<body>
    <h1>บอกรักเหมียวมุก </h1>
    <form method="POST">
        <input type="text" name="comment" placeholder="Enter your comment" required>
        <button type="submit">Submit</button>
    </form>
    
    <h2>Comments</h2>
    <div id="comments">
        <!-- Comments will appear here -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $comment = $_POST["comment"];
            echo "<p>$comment</p>";
        }
        
        ?>
        <!--  
        ซ่อนอยู่ใน element ที่ id = flag data-flat
        const flag = document.getElementById('flag').dataset.flag;
        alert(flag);
        <script>
            console.log(a + b + c);
        </script>
        -->
    </div>
</body>
</html>
