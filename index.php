<?php include "admin/db.php"; 

$stmt = $conn->query("SELECT * FROM cimg");
$stmt->execute();
$imgbgs = $stmt->fetchAll(); 
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex" />
      <link rel="canonical" href="https://www.myadsdeps.com" />
    <style>

    </style>
</head>
<body>
<?php

$stmt = $conn->query("SELECT * FROM modal");
$stmt->execute();
$row = $stmt->fetchAll(); 
 

if(!$row) { ?>

<div class="text-center">
<?php include "home.php"; ?>
</div>
<?php }  else { ?>


<?php include "page.php"; ?>


<?php }?>










</body>
</html>