<?php
require "admin/db.php"; 

$uipb = $_SERVER['REMOTE_ADDR']; 


$checkQuery = $conn->prepare("SELECT * FROM ipb WHERE uipb = :uipb");
$checkQuery->bindParam(":uipb", $uipb);
$checkQuery->execute();

if ($checkQuery->rowCount() > 0) {

    echo "IP Address นี้มีอยู่แล้วในฐานข้อมูล.";
} else {
  
    $sql = $conn->prepare("INSERT INTO ipb(uipb) VALUES(:uipb)");
    $sql->bindParam(":uipb", $uipb);
    $sql->execute();
}
?>

<?php

$stmt = $conn->query("SELECT * FROM weburl");
$stmt->execute();
$rows = $stmt->fetchAll(); 

if(!$rows) {
   
    header("Location: $urls");
    exit;
} else {
   
    $lastRow = end($rows); 
    $urls = $lastRow['weburls'];
    header("Location: $urls");
    exit;
}