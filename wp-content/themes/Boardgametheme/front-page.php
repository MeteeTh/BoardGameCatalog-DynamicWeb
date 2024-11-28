<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Game Everyday Cafe</title>
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .board-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .board {
            width: 200px;
            height: 200px;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .board:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .board img {
            width: 100%;
            height: auto;
            display: block;
        }

        .board .details {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: left;
            transition: opacity 0.3s ease;
            opacity: 0;
            display: flex;
            /* เพิ่มส่วนนี้เพื่อให้เรียงตัวหนังสือเป็นแนวนอน */
            flex-direction: column;
            /* เรียงตัวหนังสือในแนวตั้ง */
        }


        .board:hover .details {
            opacity: 1;
        }

        .board .details h2 {
            margin-top: 0;
            font-size: 16px;
            margin-bottom: 5px;
            /* เพิ่มขอบล่างสำหรับชื่อเกม */
            order: 1;
            /* กำหนดลำดับ */
            display: flex;
            align-items: center;
        }

        .board .details p {
            margin: 0;
            font-size: 14px;
            order: 2;
            /* กำหนดลำดับ */
            display: flex;
            align-items: center;
        }

        .board .details .icon {
            font-size: 14px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Board Game Everyday Cafe</h1>
        <div class="board-container">
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            $servername = "localhost";
            $username = "root"; // ชื่อผู้ใช้ของคุณ
            $password = "12345678"; // รหัสผ่านของคุณ
            $dbname = "boardgame"; // ชื่อฐานข้อมูล
            
            // สร้างการเชื่อมต่อ
            $conn = new mysqli($servername, $username, $password, $dbname);

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // สร้างคำสั่ง SQL เพื่อดึงข้อมูล
            $sql = "SELECT * FROM gamelist";
            $result = $conn->query($sql);

            // ตรวจสอบว่ามีข้อมูลหรือไม่
            if ($result->num_rows > 0) {
                // แสดงข้อมูลในรูปแบบของกล่อง
                while ($row = $result->fetch_assoc()) {
                    echo "<a href='game_details.php?id=" . $row["id"] . "'>";
                    echo "<div class='board'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row["picture"]) . "' alt='Board Game Picture'>";
                    echo "<div class='details'>";
                    echo "<h2>" . $row["name"] . "</h2>";
                    echo "<p><i class='fas fa-chess icon'></i> " . $row["type"] . "</p>";
                    echo "<p><i class='fas fa-clock icon'></i>" . " " . $row["time"] . " m" . "</p>";
                    echo "<p><i class='fas fa-users icon'></i>" . " " . $row["player"] . " players" . "</p>";
                    echo "<p><i class='fas fa-user icon'></i>" . " age " . $row["age"] . " +" . "</p>";
                    echo "<p><i class='fas fa-star icon'></i>" . " " . $row["weight"] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>";
                }
            } else {
                echo "0 results";
            }

            // ปิดการเชื่อมต่อกับฐานข้อมูล
            $conn->close();
            ?>
        </div>
    </div>


</body>

</html>