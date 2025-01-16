<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable XSS Website</title>
</head>
<body>
    <h1>Vulnerable XSS Example</h1>


    <!-- Reflected XSS -->
    <h2>Search</h2>
    <form method="GET" action="">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search">
        <button type="submit">Submit</button>
    </form>
    <?php
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        echo "<p>Search results for: $search</p>"; // ช่องโหว่ Reflected XSS
    }
    ?>

    <!-- Stored XSS -->
    <h2>Comments</h2>
    <form method="POST" action="">
        <label for="comment">Leave a comment:</label>
        <textarea id="comment" name="comment"></textarea>
        <button type="submit">Post</button>
    </form>
    <?php
    // อ่านและแสดงคอมเมนต์
    $commentsFile = 'comments.txt';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment'])) {
        $comment = $_POST['comment'];
        file_put_contents($commentsFile, $comment . PHP_EOL, FILE_APPEND); // บันทึกคอมเมนต์ลงไฟล์
    }

    if (file_exists($commentsFile)) {
        $comments = file($commentsFile, FILE_IGNORE_NEW_LINES);
        echo "<ul>";
        foreach ($comments as $comment) {
            echo "<li>$comment</li>"; // ช่องโหว่ Stored XSS
        }
        echo "</ul>";
    }
    ?>
    

</body>
</html>
