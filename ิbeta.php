<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comment System</title>
</head>
<body>
    <h1>Please Comment</h1>
    <form method="POST" action="validate.php">
        <input type="text" name="comment" placeholder="Enter your comment" required>
        <button type="submit">Submit</button>
    </form>
    
    <h2>Comments</h2>
    <div id="comments">
        <!-- Comments will appear here -->
        <?php
            
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $comment = ($_POST["comment"]);
                echo "<p>$comment</p>";
            }
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $input = $_POST["comment"];

                // ตรวจสอบคำตอบ
                $flag = "ISAG_CTF{ํYaerin_was_taken}";
                if ($input === $flag) {
                    echo "Correct! The flag is $flag";
                } else {
                    echo "Incorrect answer!";
                }
            }
        ?>
        <!-- <script>
            console.log("Hi")
        </script> -->
    </div>
</body>
</html>
