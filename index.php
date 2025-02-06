<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Clone with Comments</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">YouTube Clone</div>
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search">
                <button type="submit">Search</button>
            </form>
            <?php
            if (isset($_GET['search'])) {
                $searchQuery = $_GET['search']; // ไม่มีการกรองข้อมูล
                echo "<p>ผลการค้นหาสำหรับ: " . $searchQuery . "</p>"; // XSS ที่นี่
            }
            ?>

        </div>
        <div class="user-options">
            <!-- Icons for user options can be added here -->
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li>Home</li>
            <li>Explore</li>
            <li>Subscriptions</li>
            <!-- More sidebar items -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Video Cards -->
        <div class="video-card">
            <video width="100%" height="auto" controls>
                <source src="movie.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <!-- <div class="thumbnail">
            </div> -->
            <div class="video-info">
                <h3>Kali Thailand</h3>
                <p>ISAG CTF</p>
                <p>6.9B views • 1/1/2000</p>
            </div>
        </div>

        <!-- Comment Section -->
        <div class="comment-section">
            <h3>Comments</h3>
            <!-- <form id="comment-form">
                <textarea id="comment-input" placeholder="Add a public comment..." required></textarea>
                <button type="submit">Comment</button>
            </form> -->
            <form method="POST" action="">
                <label for="comment">Leave a message here:</label>
                <br />
                <textarea id="comment" name="comment" style="resize:none; height:30px"></textarea>
                <button id="submit" type="submit">add</button>
                <br />
            </form>
            <div id="comments-container">
                <!-- Submitted comments will appear here -->
                <?php
                $commentsFile = 'comments.txt';

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment'])) {
                    $comment = htmlspecialchars($_POST["comment"]); // ป้องกัน XSS
                    file_put_contents($commentsFile, $comment . PHP_EOL, FILE_APPEND);
                }

                if (file_exists($commentsFile)) {
                    $comments = file($commentsFile, FILE_IGNORE_NEW_LINES);
                    echo "<ul>";
                    foreach ($comments as $comment) {
                        // แปลง URL ให้เป็นลิงก์
                        $commentWithLinks = preg_replace(
                            '/((http|https):\/\/[^\s]+|www\.[^\s]+)/i', // ตรวจจับ http://, https:// และ www.
                            '<a href="$1" target="_blank">$1</a>',
                            $comment
                        );

                        // ตรวจจับกรณีที่เริ่มต้นด้วย "www." แล้วเพิ่ม "http://"
                        $commentWithLinks = preg_replace(
                            '/<a href="www\./i',
                            '<a href="http://www.',
                            $commentWithLinks
                        );

                        echo "<li>$commentWithLinks</li>";
                    }
                    echo "</ul>";
                }
                ?>

            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>