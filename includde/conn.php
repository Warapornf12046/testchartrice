<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "wp120646";
$database = "rice";

// ทำการเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password, $database);

// เช็คการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
