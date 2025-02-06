<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Clone with Comments</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="bar-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li><a href="http://localhost:8000">Home</a></li>
                <li><a href="http://localhost:8000/explore.php">Explore</a></li>
                <!-- <li><a href="http://localhost:8000">Subscriptions</a></li> -->
                <!-- More sidebar items -->
            </ul>
        </div>
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="logo">YouTube Clone</div>
            <div class="search-bar">
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Search">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="user-options">
                <!-- Icons for user options can be added here -->
            </div>
        </nav>
    </div>

    <div class="main-content">
        <div class="result">
            <?php
            if (isset($_GET['search'])) {
                $searchQuery = $_GET['search']; // ไม่มีการกรองข้อมูล
                echo "<p>ผลการค้นหาสำหรับ: " . htmlspecialchars($searchQuery) . "</p>"; // ป้องกัน XSS
            }
            ?>

        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>