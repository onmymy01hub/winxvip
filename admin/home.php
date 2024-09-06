<?php
  session_start();
include "db.php";



$home = 1; 

// ตรวจสอบว่ามีแถวที่มีค่า Home = 1 หรือไม่
$stmt = $conn->prepare("SELECT * FROM modal WHERE Home = ?");
$stmt->bindParam(1, $home, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll();

if(count($result) > 0) {
    // มีข้อมูล, จะลบข้อมูลนี้
    $deleteStmt = $conn->prepare("DELETE FROM modal WHERE Home = ?");
    $deleteStmt->bindParam(1, $home, PDO::PARAM_INT);
    $deleteStmt->execute();
} else {
    // ไม่มีข้อมูล, จะเพิ่มข้อมูล
    $insertStmt = $conn->prepare("INSERT INTO modal (Home) VALUES (?)");
    $insertStmt->bindParam(1, $home, PDO::PARAM_INT);
    $insertStmt->execute();
}

header("Location: index.php"); // หรือหน้าอื่นที่ต้องการเปลี่ยนเส้นทาง
exit; // 

?>