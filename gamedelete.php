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

// รับค่า id จาก URL
$id = $_GET['id'];

// สร้างคำสั่ง SQL เพื่อลบข้อมูล
$sql = "DELETE FROM gamelist WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "ลบข้อมูลเรียบร้อยแล้ว";
    // Redirect ไปยังหน้าอื่นหลังจากที่ทำการเพิ่มข้อมูลเรียบร้อยแล้ว
    header("Location: result_save.php");
    exit(); // ตรงนี้จำเป็นต้องใส่เพื่อหยุดการทำงานของสคริปต์
} else {
    echo "Error deleting record: " . $conn->error;
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>