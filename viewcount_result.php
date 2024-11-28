<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 5 Most Viewed Games</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/boardgame/wp-content/uploads/fbrfg/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/boardgame/wp-content/uploads/fbrfg/favicon-16x16.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #91C650;
            /* ใช้สีเขียวเข้มเป็นพื้นหลัง */

            overflow-x: hidden;
        }

        h1 {
            text-align: center;
            /* จัดตำแหน่งข้อความให้อยู่ตรงกลาง */
            margin-bottom: 18px;
            /* เพิ่มระยะห่างด้านล่างของข้อความ */
            font-size: 34px;
            /* ขนาดข้อความ */
            font-weight: bold;
            /* ตัวหนา */
            color: #FFD700;
            /* สีข้อความเป็นทองแดง */
            background: linear-gradient(45deg, #4CAF50, #FF8C00, #FFD700, #4CAF50);
            /* gradient สีพื้นหลัง */
            -webkit-background-clip: text;
            /* ให้พื้นหลังแสดงผลเฉพาะในข้อความ */
            background-clip: text;
            /* ให้พื้นหลังแสดงผลเฉพาะในข้อความ */
            animation: rainbow 5s linear infinite;
            /* เพิ่ม animation ทำให้เปลี่ยนสีเป็น rainbow ตลอดเวลา */
            -webkit-text-stroke: 1px black;
            /* เพิ่ม stroke ดำ */
            text-stroke: 2px black;
            /* เพิ่ม stroke ดำ */
        }

        @keyframes rainbow {
            0% {
                filter: hue-rotate(0deg);
            }

            100% {
                filter: hue-rotate(360deg);
            }
        }




        .game-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .game-list-item {
            border: 1px solid #ddd;
            /* เปลี่ยนสีเส้นขอบ */
            background-color: #fff;
            /* เปลี่ยนสีพื้นหลัง */
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            border-radius: 8px;
            /* เพิ่มมุมโค้ง */
        }

        .game-name {
            font-size: 20px;
            margin-bottom: 5px;
            color: #333;
            /* เปลี่ยนสีข้อความ */
        }

        .game-views {
            font-size: 18px;
            color: red;
            margin-left: auto;
        }

        .game-cover {
            width: 100px;
            height: 100px;
            object-fit: cover;
            object-position: top;
            margin-right: 15px;
            overflow: hidden;
            border-radius: 8px;
            /* เพิ่มมุมโค้ง */
        }

        .game-list {
            max-height: calc(100vh - 120px);


        }

        @media (max-width: 768px) {
            body {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
</head>

<body>
    <h1>Top 5 Most Viewed Games</h1>
    <ul class="game-list">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "12345678";
        $dbname = "boardgame";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM gamelist ORDER BY view DESC LIMIT 5";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li class='game-list-item'>";
                echo "<img class='game-cover' src='data:image/jpeg;base64," . base64_encode($row["picture"]) . "' alt='Board Game Picture'>";
                echo "<div>";
                echo "<p class='game-name'>" . $row["name"] . "</p>";
                echo "<p class='game-views'>" . $row["view"] . " views</p>";
                echo "</div>";
                echo "</li>";
            }
        } else {
            echo "<li class='game-list-item'><p>No games found.</p></li>";
        }
        $conn->close();
        ?>
    </ul>
</body>

</html>