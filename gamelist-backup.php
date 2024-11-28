<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .container {
        padding: 20px;
        margin-left: 75px;
    }

    .board:hover .details h2,
    .board:hover .details p {
        color: #fff;
        /* เปลี่ยนสีตัวหนังสือเป็นสีขาว */
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
        height: 100%;
        object-fit: cover;
        object-position: center top;
border-radius: 5px;
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
        flex-direction: column;
    }

    .board:hover .details {
        opacity: 1;
    }

    .board .details h2 {
        margin-top: 0;
        font-size: 16px;
        margin-bottom: 5px;
        order: 1;
        display: flex;
        align-items: center;
    }

    .board .details p {
        margin: 0;
        font-size: 14px;
        order: 2;
        display: flex;
        align-items: center;
    }

    .board .details .icon {
        font-size: 14px;
        margin-right: 5px;
    }
</style>

<div class="container">
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
                echo "<a href='http://localhost/boardgame/game-details?id=" . $row["id"] . "'>";
                echo "<div class='board'>";
                echo "<img src='data:image/jpeg;base64," . base64_encode($row["picture"]) . "' alt='Board Game Picture'>";
                echo "<div class='details'>";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<p><i class='fas fa-chess icon'></i> " . $row["type"] . "</p>";
                echo "<p><i class='fas fa-users icon'></i>" . " " . $row["player"] . " Players" . "</p>";
                echo "<p><i class='fas fa-user icon'></i>" . "  Age " . $row["age"] . " +" . "</p>";
                echo "<p><i class='fas fa-clock icon'></i>" . "  " . $row["time"] . " m" . "</p>";
                echo "<p><i class='fas fa-star icon'></i>" . "  " . $row["weight"] . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</a>";
            }
        } else {
            // ไม่ต้องทำอะไรเมื่อไม่มีข้อมูล
        }

        // ปิดการเชื่อมต่อกับฐานข้อมูล
        $conn->close();
        ?>
    </div>
</div>