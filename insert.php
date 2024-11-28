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

<?php
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

// สร้างคำสั่ง SQL สำหรับการดึงจำนวนเกมทั้งหมด
$sql_count = "SELECT COUNT(*) as total_games FROM gamelist";

// ประมวลผลคำสั่ง SQL
$result_count = $conn->query($sql_count);

// ตรวจสอบว่ามีข้อมูลที่ได้จากการดึงหรือไม่
if ($result_count->num_rows > 0) {
  // ดึงข้อมูลเกมทั้งหมดจากฐานข้อมูล
  $row_count = $result_count->fetch_assoc();

} else {
  echo "<p>ไม่พบข้อมูลเกมในฐานข้อมูล</p>";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>


<?php

// ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่ และตรวจสอบว่ามีการกดปุ่ม Submit หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

  // ตรวจสอบความถูกต้องของข้อมูล
  $youtube_link = validate_input($_POST['link']);

  // แก้ไข URL โดยใช้ str_replace()
  $youtube_link = str_replace('watch?v=', 'embed/', $youtube_link);

  // ตรวจสอบว่าช่อง expansions ว่างหรือไม่
  $expansions = isset($_POST['expansions']) ? validate_input($_POST['expansions']) : "";

  // ตรวจสอบว่าทุกช่องสำคัญมีข้อมูลหรือไม่ ยกเว้นช่อง expansions
  if (!empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['category']) && !empty($_POST['keyword']) && !empty($_POST['time']) && !empty($_POST['age']) && !empty($_POST['players_min']) && !empty($_POST['players_max']) && !empty($_POST['weight']) && !empty($_POST['description']) && !empty($_POST['howtoplay']) && !empty($_POST['link'])) {
    $name = addslashes($_POST['name']);
    $type = validate_input($_POST['type']);
    $category = validate_input($_POST['category']);
    $players_min = validate_input($_POST['players_min']);
    $players_max = validate_input($_POST['players_max']);
    $time = validate_input($_POST['time']);
    $age = validate_input($_POST['age']);
    $weight = validate_input($_POST['weight']);
    $description = validate_input($_POST['description']);
    $howtoplay = validate_input($_POST['howtoplay']);
    $link = validate_input($_POST['link']);
    $keyword = validate_input($_POST['keyword']);

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
      die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }

    // ตรวจสอบและแก้ไขข้อมูล weight
    $weight_input = validate_input($_POST['weight']);

    // ตรวจสอบว่าข้อมูล weight เป็นทิศนิยม 2 ตำแหน่งหรือไม่
    if (strpos($weight_input, '.') !== false) {
      // ถ้ามีทศนิยม ตรวจสอบว่ามีทศนิยมเป็น 2 ตำแหน่งหรือไม่
      $weight_parts = explode('.', $weight_input);
      if (strlen($weight_parts[1]) === 2) {
        // ถ้ามีทศนิยม 2 ตำแหน่งแล้ว ไม่ต้องทำอะไรเพิ่ม
        $weight = $weight_input;
      } else {
        // ถ้าทศนิยมไม่ครบ 2 ตำแหน่ง ให้เติมเข้าไป
        $weight = number_format($weight_input, 2, '.', '');
      }
    } else {
      // ถ้าไม่มีทศนิยม ให้เพิ่ม ".00" เข้าไป
      $weight = $weight_input . ".00";
    }


    // ตรวจสอบและปรับปรุงข้อมูลของ players min และ max
    $players_min = intval($_POST['players_min']);
    $players_max = intval($_POST['players_max']);

    // สร้างข้อมูล JSON
    $players_data = array(
      "min" => $players_min,
      "max" => $players_max
    );
    // แปลงข้อมูลเป็น JSON
    $json_players_data = json_encode($players_data);

    // ตรวจสอบว่ามีการอัปโหลดไฟล์ภาพหรือไม่
    if ($_FILES["picture"]["error"] == UPLOAD_ERR_OK) {
      // อ่านข้อมูลจากไฟล์ภาพ
      $image = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
    } else {
      // ถ้าไม่มีการอัปโหลดไฟล์ภาพ กำหนด $image เป็น null หรือค่าว่าง
      $image = null; // หรือให้เป็นค่าว่าง $image = '';
    }



    // สร้างคำสั่ง SQL สำหรับการเพิ่มข้อมูลรวมทั้งรูปภาพ
    $sql_insert = "INSERT INTO gamelist (name, type, category, player, time, age, weight, description, howtoplay, expansions, link, players, keyword, picture)
                    VALUES ('$name', '$type', '$category', '$time', '$age', '$weight', '$description', '$howtoplay', '$expansions', '$youtube_link', '$json_players_data', '$keyword', '$image')";
    // ประมวลผลคำสั่ง SQL
    if ($conn->query($sql_insert) === TRUE) {
      echo "เพิ่มข้อมูลเรียบร้อยแล้ว";

      // Redirect ไปยังหน้าอื่นหลังจากที่ทำการเพิ่มข้อมูลเรียบร้อยแล้ว
      header("Location: result_save.php");
      exit(); // ตรงนี้จำเป็นต้องใส่เพื่อหยุดการทำงานของสคริปต์
    } else {
      echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
  } else {
    $errormes = '<br><div style="text-align: center; color: red; font-weight: bold; margin-top:-40px;">"กรุณากรอกข้อมูลให้ครบถ้วน"</div>';
  }

}

// ฟังก์ชันสำหรับตรวจสอบและทำความสะอาดข้อมูล
function validate_input($data)
{
  $data = trim($data); // ลบช่องว่างที่อยู่ด้านหน้าและด้านหลังของข้อความ
  $data = stripslashes($data); // ลบ backslashes (\) ที่อาจถูกใช้เพื่อ escape ข้อมูล
  $data = htmlspecialchars($data);  // แปลงตัวอักษรที่เป็นตัวแทนของเครื่องหมาย HTML เช่น "<" และ ">" เป็น HTML entities เพื่อป้องกันการแทรกโค้ดที่ไม่ปลอดภัย
  return $data;
}

?>

<!DOCTYPE html>
<html>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

<head>
  <title>แคร์รอตจะเพิ่มเกม ! &#8211; Game Master</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image" href="images/cat2.jpg">
  <style>
    body {
      font-family: Sarabun, Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url(images/cat2.jpg);

    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 50%;
      margin: auto;
      font-size: 20px;
      line-height: 2.0;
    }


    h1 {
      text-align: center;
      font-weight: bold;
      color: #ffcc00;
      /* เปลี่ยนสีเป็นเหลือง */
      background-color: #333;
      /* ใส่พื้นหลังสีเทาเข้ม */
      padding: 10px 20px;
      /* กำหนด padding สำหรับระยะห่าง */

      margin: auto;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      color: #333;
    }

    input[type="text"],
    input[type="number"],
    textarea {
      width: calc(100% - 22px);
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 18px;
    }

    textarea {
      height: 100px;
      resize: vertical;
    }

    input[type="file"] {
      margin-top: 10px;
      font-size: 18px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: calc(100% - 22px);
      margin-top: 10px;
      font-size: 20px;
      font-weight: bold;

    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .required {
      color: red;
    }

    hr {
      border: 1px solid #ccc;
    }

    #gameCount {
      font-size: 22px;
      font-weight: bold;
      color: #333;
      width: auto;
      height: auto;
      position: absolute;
      margin-left: 10px;
      background-color: #ffcc00;
      padding: 5px;
      border-radius: 5px;
    }
  </style>
</head>

<body>

  <h1 style="position: relative; text-align: center;">
    เพิ่มบอร์ดเกม
  </h1>
  <span id="gameCount">
    จำนวนบอร์ดเกมในฐานข้อมูล: <span>
      <?php echo $row_count['total_games']; ?>
    </span> เกม
  </span>
  <form action="insert.php" method="post" enctype="multipart/form-data">
    <?php echo $errormes; ?>
    <label for="name"><span class="required">*</span> Name:</label><br>
    <input type="text" id="name" name="name" placeholder="ป้อนชื่อเกม" autofocus><br>
    <label for="type"> <span class="required">*</span> Type: (ใส่หลายประเภทได้)</label><br>
    <input type="text" id="type" name="type" placeholder="เช่น Family, Party"><br>
    <label for="category"> <span class="required">*</span> Category: (ใส่หลายหมวดหมู่ได้)</label><br>
    <input type="text" id="category" name="category" placeholder="เช่น Card Game, Bluffing"><br>
    <label for="keyword"> <span class="required">*</span> Keywords: (ใส่หลายคีย์เวิร์ดได้)</label><br>
    <input type="text" id="keyword" name="keyword" placeholder="เช่น พ่อมด, หมาป่า, สืบสวน"><br>
    <label for="picture"> <span class="required">*</span> Picture:</label><br>
    <input type="file" id="picture" name="picture"><br><br>


    <label for="players_min"> <span class="required">*</span> Min Players:</label><br>
    <input type="number" id="players_min" name="players_min" placeholder="จำนวนผู้เล่นน้อยสุดที่รองรับ"><br>
    <label for="players_max"> <span class="required">*</span> Max Players:</label><br>
    <input type="number" id="players_max" name="players_max" placeholder="จำนวนผู้เล่นมากสุดที่รองรับ"><br>

    <label for="time"> <span class="required">*</span> Time: (นาที)</label><br>
    <input type="text" id="time" name="time" placeholder="ใส่แค่ตัวเลข เช่น 20-40, 15"><br>
    <label for="age"> <span class="required">*</span> Age: (กลุ่มอายุ X ปีขึ้นไป)</label><br>
    <input type="number" id="age" name="age" placeholder="ใส่แค่ตัวเลข เช่น 8 (จะหมายถึง 8 ปีขึ้นไป)"><br>
    <label for="weight"> <span class="required">*</span> Weight: (เต็ม 5)(หมายถึงคะแนนความยาก)</label><br>
    <input type="number" step="0.01" id="weight" name="weight" placeholder="ใส่เป็นทิศนิยม เช่น 2.55"><br><br>
    <label for="description"> <span class="required">*</span> Description:</label><br>
    <textarea id="description" name="description"
      placeholder="คำอธิบายเกม (คลิกที่มุมขวาล่าง เพื่อยืดหดช่องกรอกข้อมูลได้)"></textarea><br>
    <label for="howtoplay"> <span class="required">*</span> How to Play:</label><br>
    <textarea id="howtoplay" name="howtoplay"
      placeholder="วิธีเล่น (คลิกที่มุมขวาล่าง เพื่อยืดหดช่องกรอกข้อมูลได้)"></textarea><br>
    <label for="link"> <span class="required">*</span> Link:</label><br>
    <input type="text" id="link" name="link"
      placeholder="Youtube คลิปการสอนเล่น เช่น https://www.youtube.com/watch?v=iI2Evpbraoc"><br><br>
    <label for="expansions">Expansions: (optional)</label><br>
    <input type="text" id="expansions" name="expansions" placeholder="ส่วนเสริมของเกม (ไม่มีปล่อยว่างได้)"><br><br>

    <input type="submit" name="submit" value="Submit">
  </form>
</body>

</html>