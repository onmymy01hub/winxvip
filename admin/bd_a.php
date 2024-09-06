<?php 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "xxx";

  // สร้างการเชื่อมต่อ
  $conn = new mysqli($servername, $username, $password, $dbname);

  // ตรวจสอบการเชื่อมต่อ
  if ($conn->connect_error) {
      die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
  }
     ?>