<?php
// ตั้งค่า session cookie ให้มีอายุเฉพาะเมื่อเปิดเว็บไซต์
ini_set('session.cookie_lifetime', 0);
session_start();

// ตรวจสอบว่ามี session login หรือไม่ ถ้าไม่มีให้ redirect ไปที่หน้า login.php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// ปรับเปลี่ยน header เพื่อไม่ให้ cache หน้าเว็บ
header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "boardgame";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// รับค่า id และข้อมูลของเกมจากฟอร์ม
$id = $_POST['id'];
$name = $conn->real_escape_string($_POST['name']);
$type = $conn->real_escape_string($_POST['type']);
$category = $conn->real_escape_string($_POST['category']);
$description = $conn->real_escape_string($_POST['description']);
$howtoplay = $conn->real_escape_string($_POST['howtoplay']);
$expansions = $conn->real_escape_string($_POST['expansions']);
$players_min = intval($_POST['players_min']); // แปลงให้เป็นตัวเลข
$players_max = intval($_POST['players_max']); // แปลงให้เป็นตัวเลข
$players = json_encode(array("min" => $players_min, "max" => $players_max));
$time = $conn->real_escape_string($_POST['time']);
$age = intval($_POST['age']); // แปลงให้เป็นตัวเลข
$weight = floatval($_POST['weight']); // แปลงให้เป็นทศนิยม
$link = $conn->real_escape_string($_POST['link']);
$keyword = $conn->real_escape_string($_POST['keyword']);

// แก้ไข URL โดยใช้ str_replace()
$link = str_replace('watch?v=', 'embed/', $link);


// ตรวจสอบว่าผู้ใช้ต้องการแก้ไขรูปภาพหรือไม่
if (isset($_POST['editPictureCheckbox']) && $_POST['editPictureCheckbox'] == 'on') {
    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
    if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        // เปิดไฟล์รูปภาพที่อัปโหลดขึ้น
        $picture_data = file_get_contents($_FILES['picture']['tmp_name']);
        // นำข้อมูลของรูปภาพไปใส่ในตัวแปร picture สำหรับการอัปเดต
        $picture = $conn->real_escape_string($picture_data);
    } else {
        // หากไม่มีการอัปโหลดรูปภาพ ให้ใช้รูปภาพเดิม
        $picture = $_POST['currentPicture'];
    }
} else {
    // หากไม่ต้องการแก้ไขรูปภาพ ให้ใช้รูปภาพเดิม
    $picture = $_POST['currentPicture'];
}

// สร้างคำสั่ง SQL เพื่ออัปเดตข้อมูล (รวมการอัปเดตรูปภาพด้วย) ให้ทำการอัปเดตรูปภาพเฉพาะเมื่อมีการติ๊กแก้ไขรูปภาพ
if (isset($_POST['editPictureCheckbox']) && $_POST['editPictureCheckbox'] == 'on') {
    $sql = "UPDATE gamelist SET 
            name='$name', 
            type='$type', 
            category='$category', 
            description='$description', 
            howtoplay='$howtoplay', 
            expansions='$expansions',
            players='$players',
            picture='$picture',
            time='$time',
            age='$age',
            weight='$weight',
            link='$youtube_link',
            keyword='$keyword' 
            WHERE id=$id";
} else {
    $sql = "UPDATE gamelist SET 
            name='$name', 
            type='$type', 
            category='$category', 
            description='$description', 
            howtoplay='$howtoplay', 
            expansions='$expansions',
            players='$players',
            time='$time',
            age='$age',
            weight='$weight',
            link='$youtube_link',
            keyword='$keyword' 
            WHERE id=$id";
}
if ($conn->query($sql) === TRUE) {
    echo "อัปเดตข้อมูลเกมเรียบร้อยแล้ว";
    header("Location: result_save.php"); // ไปที่หน้า savereult.php
    exit;
} else {
    echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
}


// ปิดการเชื่อมต่อ
$conn->close();
?>