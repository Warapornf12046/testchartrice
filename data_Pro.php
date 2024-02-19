<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "wp120646";
$database = "ip";

// ทำการเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password, $database);

// เช็คการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// เตรียมค่าเดือนที่ได้รับจากการร้องขอ
$selectedMonth = $_POST['month'];

// เพิ่มเงื่อนไขเพื่อกรองเดือน
if (!empty($selectedMonth)) {
    $sqlQuery = "SELECT YEAR(OrderProduct_Date) AS Year,
                        MONTH(OrderProduct_Date) AS Month,
                        ServiceProduct_Name,
                        COUNT(*) AS TotalOrders
                FROM orderproduct
                JOIN serviceandproduct ON orderproduct.ServiceProduct_Id = serviceandproduct.ServiceProduct_Id
                WHERE MONTH(OrderProduct_Date) = '$selectedMonth' 
                GROUP BY YEAR(OrderProduct_Date), MONTH(OrderProduct_Date), ServiceProduct_Name
                ORDER BY Year, Month, TotalOrders DESC";
} else {
    // กรณีที่ไม่ได้เลือกเดือน ให้ดึงข้อมูลทั้งหมด
    $sqlQuery = "SELECT YEAR(OrderProduct_Date) AS Year,
                        MONTH(OrderProduct_Date) AS Month,
                        ServiceProduct_Name,
                        COUNT(*) AS TotalOrders
                FROM orderproduct
                JOIN serviceandproduct ON orderproduct.ServiceProduct_Id = serviceandproduct.ServiceProduct_Id
                GROUP BY YEAR(OrderProduct_Date), MONTH(OrderProduct_Date), ServiceProduct_Name
                ORDER BY Year, Month, TotalOrders DESC";
}

// ทำการส่งคำสั่ง SQL ไปที่ฐานข้อมูล
$result = mysqli_query($conn, $sqlQuery);

// ตรวจสอบว่ามีข้อมูลที่ได้รับหรือไม่
if (mysqli_num_rows($result) > 0) {
    // สร้างตัวแปร array เพื่อเก็บข้อมูล
    $data = array();
    // วนลูปเพื่อดึงข้อมูลและเก็บไว้ในตัวแปร $data
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
    // แสดงผลลัพธ์เป็น JSON
    echo json_encode($data);
} else {
    // ถ้าไม่มีข้อมูลในฐานข้อมูล
    echo "No data found.";
}
?>
