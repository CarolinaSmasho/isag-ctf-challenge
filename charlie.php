<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="HiddenFlag">
    <title>Comment System</title>
    <!-- ซ่อน flag ใน meta tag -->
    <meta name="flag" content="ISAG_CTF{Hidden_XSS_Flag}">
</head>
<body>
    <h1>Welcome to the Comment System</h1>
    <form method="POST">
        <input type="text" name="comment" placeholder="Enter your comment" required>
        <button type="submit">Submit</button>
    </form>
    <h2>Comments</h2>
    <div id="comments">
        <!-- Display user comments -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // XSS vulnerable point
            $comment = $_POST["comment"];
            echo "<p>" . $comment . "</p>";
        }
        ?>
    </div>
</body>
</html>
