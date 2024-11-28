<style>
    .container3 {
        display: flex;
        justify-content: center;
    }
</style>

<div class="container3">
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

    // รับค่า id จากพารามิเตอร์ที่ส่งมาจาก URL
    $id = $_GET['id'];

    // สร้างคำสั่ง SQL เพื่อดึงข้อมูล
    $sql = "SELECT * FROM gamelist WHERE id=$id";
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($result->num_rows > 0) {
        // แสดงข้อมูลในรูปแบบของกล่อง
        while ($row = $result->fetch_assoc()) {
            ?>
            <!-- แสดงวิดีโอจาก YouTube โดยใช้แท็ก iframe -->
            <iframe width="560" height="315" src="<?php echo $row["link"]; ?>" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <?php
        }
    } else {

    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
    ?>
</div>