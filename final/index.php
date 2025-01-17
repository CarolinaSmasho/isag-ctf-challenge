<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="hidden.js"></script>
    <title>Vulnerable XSS Website</title>
</head>
<body>
    <h1>Find a thing you can't see</h1>

    <form method="POST" action="">
        <label for="comment">Leave a message here:</label>
        <br />
        <textarea id="comment" name="comment" style="resize:none; height:30px"></textarea>
        <button type="submit">add</button>
        <br />
    </form>
    <hr>
    <label for="comment">Your message list:</label>
    <?php
    $commentsFile = 'comments.txt';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment'])) {
        $comment = ($_POST["comment"]);
        file_put_contents($commentsFile, $comment . PHP_EOL, FILE_APPEND);
    }

    if (file_exists($commentsFile)) {
        $comments = file($commentsFile, FILE_IGNORE_NEW_LINES);
        echo "<ul>";
        foreach ($comments as $comment) {
            echo "<li>$comment</li>"; 
        }
        echo "</ul>";
    }
    ?>
    

</body>
</html>
