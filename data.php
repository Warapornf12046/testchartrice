<?php include('include/conn.php'); ?>
<?php
// เตรียมคำสั่ง SQL เพื่อดึงข้อมูล
$sqlQuery = "SELECT student_id, student_name, marks FROM tbl_marks ORDER BY student_id";

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
