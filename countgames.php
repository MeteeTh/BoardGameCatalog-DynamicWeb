<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "boardgame";

$conn = new mysqli($servername, $username, $password, $dbname);


$bgnum = "SELECT COUNT(*) AS total_games FROM gamelist";
$bgresult = $conn->query($bgnum);
$row = $bgresult->fetch_assoc();

echo "Total games: " . $row["total_games"];

$conn->close();
?>