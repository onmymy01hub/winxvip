<?php session_start(); ?>
<?php 
include "db.php";



if (isset($_POST['imges'])) {
   
    $img = $_FILES['img'];

        $allow = array('jpg', 'jpeg', 'png', 'gif');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'img/'.$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                if (move_uploaded_file($img['tmp_name'], $filePath)) {
                    $sql = $conn->prepare("INSERT INTO imges(img) VALUES(:img)");
                    $sql->bindParam(":img", $fileNew);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Data has been inserted successfully";
                        header("location: index.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: index.php");
                    }
                }
            }
        }
}
if (isset($_POST['imgbg'])) {
   
    $img = $_FILES['img'];

        $allow = array('jpg', 'jpeg', 'png', 'gif');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'imgbg/'.$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                if (move_uploaded_file($img['tmp_name'], $filePath)) {
                    $sql = $conn->prepare("INSERT INTO cimg(img) VALUES(:img)");
                    $sql->bindParam(":img", $fileNew);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Data has been inserted successfully";
                        header("location: index.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: index.php");
                    }
                }
            }
        }
}
if (isset($_POST['weburl'])) {
   
    $weburls = $_POST['weburls'];
    $urllines = $_POST['urllines'];

      
    $sql = $conn->prepare("INSERT INTO weburl(weburls, urllines) VALUES(:weburls, :urllines)");
    $sql->bindParam(":weburls", $weburls);
    $sql->bindParam(":urllines", $urllines);
    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "successfully";
                        header("location: index.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: index.php");
                    }
                }
if (isset($_POST['pfb_b'])) {
   
    $pixel = $_POST['pixel'];

      
                    $sql = $conn->prepare("INSERT INTO pfb_b(pixel) VALUES(:pixel)");
                    $sql->bindParam(":pixel", $pixel);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Data has been inserted successfully";
                        header("location: index.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: index.php");
                    }
                }

?>