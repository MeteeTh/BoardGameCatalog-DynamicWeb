


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .container {
        padding: 20px;
        margin-left: 250px;

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

    .sidebar {
        background-color: #2c3e50;
        padding: 20px;
        width: 200px;
        border-radius: 5px;
        position: fixed;
        top: 50px;
        /* ขยับขึ้นเล็กน้อยจากด้านบน */
        left: 20px;
        /* ขยับไปทางขวาเล็กน้อย */
        z-index: 1000;
        /* ให้แถบ filter อยู่ด้านหน้าของเนื้อหา */
    }

    .sidebar h3 {
        color: #fff;
        margin-top: 0;
        margin-bottom: 10px;
    }

    .filter-list {
        list-style-type: none;
        padding: 0;
    }

    .filter-list li {
        margin-bottom: 5px;
    }

    .filter-list li a {
        text-decoration: none;
        color: #fff;
        padding: 10px 20px;
        /* เพิ่มช่องว่างของปุ่ม */
        border-radius: 25px;
        /* ทำให้มีรูปร่างเป็นวงกลม */
        display: block;
        transition: background-color 0.3s ease;
        /* เพิ่มการเคลื่อนไหวเมื่อโฮเวอร์ */
    }

    .filter-list li a:hover {
        background-color: #34495e;
    }

    .filter-item {
        color: #000;
        /* เปลี่ยนสีข้อความ */
        background-color: transparent;
        /* เปลี่ยนสีพื้นหลังเป็นโปร่งใส */
        padding: 8px 12px;
        /* ปรับขนาด padding */
        border-radius: 5px;
        /* ปรับขอบโค้ง */
        text-decoration: none;
        /* ลบเส้นใต้ข้อความ */
        transition: background-color 0.3s ease;
        /* เพิ่มการเปลี่ยนแปลงสีพื้นหลังเมื่อโฮเวอร์ */
    }

    .filter-item.active {
        background-color: #007bff;
        /* เปลี่ยนสีพื้นหลังเมื่อเลือก */
        color: #fff;
        /* เปลี่ยนสีข้อความเมื่อเลือก */
    }

    .filter-item:hover {
        background-color: #f8f9fa;
        /* เปลี่ยนสีพื้นหลังเมื่อโฮเวอร์ */
    }
</style>

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

// รับค่า type จากพารามิเตอร์ที่ส่งมาจาก URL
$type = $_GET['type'];

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลตามประเภทที่ระบุ
$sql2 = "SELECT * FROM gamelist WHERE gamelist.type='$type'";
$result2 = $conn->query($sql2);
// ตรวจสอบการกรองตามประเภทที่เลือก
if (isset($_GET['type']) && $_GET['type'] != 'all') {
    $type = $_GET['type'];
    // ใช้ prepared statement เพื่อป้องกัน SQL injection
    $sql = "SELECT * FROM gamelist WHERE type LIKE ?";
    $stmt = $conn->prepare($sql);
    // การใช้ % หน้าและหลังคำที่ค้นหาจะค้นหาคำที่มีอักขระอะไรก็ได้ก่อนหลังคำที่กำหนด
    $search_term = "%$type%";
    $stmt->bind_param("s", $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // ไม่ได้กรองตามประเภท หรือประเภทที่เลือกเป็น 'all'
    $result = $conn->query($sql);
}


?>
<div class="sidebar">
    <h3>Filter by Type</h3>
    <ul class="filter-list">
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'all' ? 'active' : ''; ?>" href="http://localhost/boardgame/gamelist.php?type=all">All</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Abstract' ? 'active' : ''; ?>" href="http://localhost/boardgame/gamefilter.php?type=Abstract">Abstract</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Children' ? 'active' : ''; ?>" href="http://localhost/boardgame/gamefilter.php?type=Children">Children</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Family' ? 'active' : ''; ?>" href="http://localhost/boardgame/gamefilter.php?type=Family">Family</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Kids' ? 'active' : ''; ?>" href="http://localhost/boardgame/gamefilter.php?type=Kids">Kids</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Party' ? 'active' : ''; ?>"
                href="?type=Party">Party</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Secret_Agent' ? 'active' : ''; ?>"
                href="?type=Secret_Agent">Secret Agent</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Spies' ? 'active' : ''; ?>"
                href="?type=Spies">Spies</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Strategy' ? 'active' : ''; ?>"
                href="?type=Strategy">Strategy</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Thematic' ? 'active' : ''; ?>"
                href="?type=Thematic">Thematic</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Wargames' ? 'active' : ''; ?>"
                href="?type=Wargames">Wargames</a></li>
        <li><a class="filter-item <?php echo isset($_GET['type']) && $_GET['type'] === 'Uncategorized' ? 'active' : ''; ?>"
                href="?type=-">Uncategorized</a></li>


    </ul>
</div>




<div class="container">
    <div class="board-container">
        <?php
        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($result2->num_rows > 0) {
            // แสดงข้อมูลในรูปแบบของกล่อง
            while ($row = $result2->fetch_assoc()) {

                echo "<a href='http://localhost/boardgame/game-details?id=" . $row["id"] . "'>";
                echo "<div class='board'>";
                echo "<img src='data:image/jpeg;base64," . base64_encode($row["picture"]) . "' alt='Board Game Picture'>";
                echo "<div class='details'>";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<p><i class='fas fa-chess icon'></i> " . $row["type"] . "</p>";
                echo "<p><i class='fas fa-users icon'></i>" . " " . $row["player"] . " Players" . "</p>";
                echo "<p><i class='fas fa-user icon'></i>" . " Age " . $row["age"] . " +" . "</p>";
                echo "<p><i class='fas fa-clock icon'></i>" . " " . $row["time"] . " m" . "</p>";
                echo "<p><i class='fas fa-star icon'></i>" . " " . $row["weight"] . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</a>";

            }
        } else {
            echo "<p>No games found.</p>";
        }

        // ปิดการเชื่อมต่อกับฐานข้อมูล
        $conn->close();
        ?>
    </div>
</div>