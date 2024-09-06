<?php
session_start();

// ตรวจสอบว่ามีการตั้งค่าเซสชัน 'loggedin' หรือไม่
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // ถ้าไม่ได้ล็อกอิน, ให้เปลี่ยนเส้นทางกลับไปหน้า login.php
    header("Location: login.php");
    exit;
}
?>


<?php 
include "db.php";




$stmt = $conn->query("SELECT * FROM images");
$stmt->execute();
$imgbgs = $stmt->fetchAll(); 


$stmt = $conn->query("SELECT * FROM cimg");
$stmt->execute();
$imgbgs = $stmt->fetchAll(); 

$stmt = $conn->query("SELECT * FROM weburl");
$stmt->execute();
$weburls = $stmt->fetchAll(); 

$stmt = $conn->query("SELECT * FROM pfb_b");
$stmt->execute();
$pixels = $stmt->fetchAll(); 

$stmt = $conn->query("SELECT * FROM ipa");
$stmt->execute();
$ipas = $stmt->fetchAll(); 
$ipa = count($ipas);

$stmt = $conn->query("SELECT * FROM ipb");
$stmt->execute();
$ipbs = $stmt->fetchAll(); 
$ipb = count($ipbs);



if (isset($_GET['deleteimg'])) {
    $id = $_GET['id'];
    $deletestmt = $conn->query("DELETE FROM images WHERE id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        header("refresh:0.1; url=index.php");
    }
    
}
if (isset($_GET['imgbg'])) {
    $id = $_GET['id'];
    $deletestmt = $conn->query("DELETE FROM cimg WHERE id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        header("refresh:0.1; url=index.php");
    }
    
}
if (isset($_GET['weburl'])) {
    $id = $_GET['id'];
    $deletestmt = $conn->query("DELETE FROM weburl WHERE id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        header("refresh:0.1; url=index.php");
    }
    
}
if (isset($_GET['pixelx'])) {
    $id = $_GET['id'];
    $deletestmt = $conn->query("DELETE FROM pfb_b WHERE id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        header("refresh:0.1; url=index.php");
    }
    
}



// สมมติว่า $conn เป็นการเชื่อมต่อฐานข้อมูล PDO ที่สร้างไว้แล้ว
echo $ipa;
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title>Dashboard Template · Bootstrap</title>
  <meta name="robots" content="noindex" />
  <link rel="canonical" href="https://www.myadsdeps.com" />
  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/dashboard/">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
    crossorigin="anonymous"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    body {
      font-size: .875rem;
    }

    .feather {
      width: 16px;
      height: 16px;
      vertical-align: text-bottom;
    }

    /* Sidebar*/

    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 100;
      /* Behind the navbar */
      padding: 48px 0 0;
      /* Height of navbar */
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    @media (max-width: 767.98px) {
      .sidebar {
        top: 5rem;
      }
    }

    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px);
      padding-top: .5rem;
      overflow-x: hidden;
      overflow-y: auto;
      /* Scrollable contents if viewport is shorter than content. */
    }

    .sidebar .nav-link {
      font-weight: 500;
      color: #333;
    }

    .sidebar .nav-link .feather {
      margin-right: 4px;
      color: #727272;
    }

    .sidebar .nav-link.active {
      color: #007bff;
    }

    .sidebar .nav-link:hover .feather,
    .sidebar .nav-link.active .feather {
      color: inherit;
    }

    .sidebar-heading {
      font-size: .75rem;
      text-transform: uppercase;
    }

    /*Navbar*/
    .navbar-brand {
      padding-top: .75rem;
      padding-bottom: .75rem;
      font-size: 1rem;
      background-color: rgba(0, 0, 0, .25);
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .navbar-toggler {
      top: .25rem;
      right: 1rem;
    }

    .navbar .form-control {
      padding: .75rem 1rem;
      border-width: 0;
      border-radius: 0;
    }

    .form-control-dark {
      color: #fff;
      background-color: rgba(255, 255, 255, .1);
      border-color: rgba(255, 255, 255, .1);
    }

    .form-control-dark:focus {
      border-color: transparent;
      box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
    }
  


  </style>
</head>

<body>

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="btn btn-info mb-3 mt-3 " aria-current="page" href="../" target="bank">
                <span data-feather="home mb-2 mt-2"></span>
                GO TO HomePage
              </a>
            </li>
            <li class="nav-item">
              <a class="btn btn-info mb-3 mt-3 " aria-current="page" href="#check" target="bank">
                <span data-feather="home mb-2 mt-2"></span>
                ตรวจสอบผู้ชม
              </a>
            </li>
            <li class="nav-item">
              <a class="btn btn-info mb-3 mt-3 " aria-current="page" href="#web" target="bank">
                <span data-feather="home mb-2 mt-2"></span>
                ตรวจสอบผู้ชม สมัคร
              </a>
            </li>



            <li class="nav-item mb-5 mt-5">
            <?php

$stmt = $conn->query("SELECT * FROM modal");
$stmt->execute();
$row = $stmt->fetchAll(); 

if(!$row) { ?>
    <form action="home.php" method="post">
    <button type="submit" class="btn btn-secondary mb-5 mt-5" name="toggleHome">หน้าเทา-เปิดอยู่</button></form>

    <?php 

}  else { ?>
 
 <form action="home.php" method="post">
    <button type="submit" class="btn btn-light" name="toggleHome">หน้าขาว-เปิดอยู่</button>
</form>
 <?php
}


?>

             

            </li>
           
         
      </nav>
      <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']); 
                    header("refresh:0.5; url=index.php");
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); 
                ?>
            </div>
        <?php } ?>



      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
       
      <div class="d-flex justify-content-around mt-5">
      <h3>  เข้าถึงหน้าแรก</h3>
      <h3>  เข้าถึงหน้าสมัคร</h3>
      <h3>  เข้าถึงหน้าไลน์</h3>


</div>
      <div class="d-flex justify-content-around">
   
      
       <secssion class="a">
      
       <p><?php echo $ipa; ?></p>
  
       </secssion>
      

       <secssion class="b">
       <p><?php echo $ipb; ?></p>
       </secssion>


       <secssion class="c">
  
       </secssion>
      </div>



      <div class="d-flex justify-content-around mt-5">



      
     <div class="box">
        <h4>ใส่รูปภาพหลัก </h4>
     
     
     
        <form action="upload.php" method="post" enctype="multipart/form-data">
    <div>
     
        <input type="file" name="images[]" id="images" class="input" accept=".jpg, .jpeg, .png" multiple required>
    </div>
    <div>
        <p>width</p>
        <input type="number" name="width" id="width" min="1" value="480" required>
    </div>
    <br>
    <div>
    <p for="width">height</p>
        <input type="number" name="height" id="height" min="1" value="480" required>
    </div>
    <br>
    <button id="submit" type="submit">อัปโหลด</button>
</form>
 
<?php
            // ดึงข้อมูลรูปภาพจากฐานข้อมูล
            $stmt = $conn->query("SELECT * FROM images");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($rows) {
                foreach($rows as $row) {
                    $id = $row['id'];
                    $img = $row['name'];
                    ?>
           
                <div class="imges p-2"> <img src="uploads/<?php echo $img; ?>" width="150"  alt="<?php echo $img; ?>"></div>
                <form action="index.php" method="get">   <input type="hidden" name="id" value="<?php echo $id;?>" >  <button class="" type="submit"name="deleteimg">ลบ</button> </form>
                            <?php  }  ?>

             </section>
             <?php } else { } ?>





<p class="h5">สามารถลากไฟล์มาวางได้เลย</p>

<br>

 
 
  <!---------------------------------------22222--->
     </div>
     <div class="box">
        <h4>ใส่รูปภาพ BG</h4>
      
        <?php 
    if (!$imgbgs){ ?>
  <form action="insert.php" method="post" enctype="multipart/form-data">
        <input type="file" name="img" id='imge'class='input' required> <br><br>
       <div class="">
      <button type="submit" class="btn btn-secondary" id="submitxxx" value="submit" name="imgbg"> submit</button></div>
      </form> 

<?php
}  else {
    foreach($imgbgs as $imgbg)  { 
   $id = $imgbg['id'];
   $img = $imgbg['img'];
   
   
   ?>
       

      <img src="imgbg/<?php echo$img;?>" width="100">
   <form action="index.php" method="get"> 
   <input type="hidden" name="id" value="<?php echo$id;?>" > 
   <button class="" type="submit"name="imgbg">ลบ</button> </form> <br>



   <?php 
}}

?>

  <!---------------------------------------22222--->
     </div>

     <div class="box">
        <h4>URL</h4>
      

         <form action="insert.php" method="post" enctype="multipart/form-data">
          <label for="">ใส่ลิงค์หน้าเว็บ (หน้าสมัคร) </label>
        <input type="url" class="form-control" name="weburls"   placeholder="ใส่ลิงค์หน้าเว็บ (หน้าสมัคร)"><br>
        <label for="">ใส่ลิงค์ Line  </label>
        <input type="url" class="form-control" name="urllines" id='urllines' placeholder="ใส่ลิงค์ Line ">
        <br>
       <div class="">
      <button type="submit" class="btn btn-primary" id="submitxxx" value="submit" name="weburl"> submit</button></div>
      </form> 

<?php
if (!$weburls){ 
}  else {
    foreach($weburls as $weburl)  { 
   $id = $weburl['id'];
   $weburls = $weburl['weburls'];
   $urllines = $weburl['urllines'];
   
   ?>
       

      <p><?php echo $weburls;?></p>
      <p><?php echo $urllines;?></p>
   <form action="index.php" method="get"> 
   <input class="form-control" type="hidden" name="id" value="<?php echo$id;?>" > 
   <button class="" type="submit"name="weburl">ลบ</button> </form> <br>



   <?php 
}}

?>

     </div>
  <!---------------------------------------22222--->

  <div class="box">
        <h4>Pixel - FB</h4>

       
        

<?php
if (!$pixels){  ?>


<form action="insert.php" method="post" enctype="multipart/form-data">
        <input type="text" class="form-control" name="pixel" id='imge' required> <br><br>
      
      <button type="submit" class="btn btn-info" id="submitxxx" value="submit" name="pfb_b"> submit</button>
      </form> 

<?php
}  else {
    foreach($pixels as $pixelss)  { 
   $id = $pixelss['id'];
   $pixel = $pixelss['pixel'];
   
   
   ?>
       
      
    
  
    



   <?php 
} 
?>
<form action="index.php" method="get"> 
<input type="hidden" name="id" value="<?php echo$id;?>" > 
<button class="" type="submit"name="pixelx">ลบ</button> </form> <br>

<?php } ?>

</div>
  <!---------------------------------------22222--->


  

<br><br>

</div>

<hr>
<div id="check" class="check">


<?php
include "db.php";


$stmt = $conn->query("SELECT * FROM ipa");
$stmt->execute();
$ipas = $stmt->fetchAll(); 
$ipa = count($ipas);


?>

  <div class="container mt-5">
  <h3><?php echo $ipa; ?></h3>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">> > > >   IP   < < < <</th>
      <th scope="col">referer</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>


    <?php 
if (!$ipas){
}  else {
    foreach($ipas as $ipa)  { 
   $id = $ipa['id'];
   $uipa = $ipa['uipa'];
   $referer = $ipa['referer'];
   $time = $ipa['time'];
   
   
   ?>
 <tr>
     
      <td><?php echo $id; ?></td>
      <td><?php echo $uipa; ?></td>
      <td><?php echo $referer; ?></td>
      <td><?php echo $time; ?></td>
    </tr>


<?php 
}}

?>


   
   
  </tbody>
</table>

</div>







<!--------------------------------------------------------------------------------------------->

<hr>
<div id="web" class="check">


<?php
include "db.php";


$stmt = $conn->query("SELECT * FROM ipb");
$stmt->execute();
$ipas = $stmt->fetchAll(); 
$ipa = count($ipas);


?>

  <div class="container mt-5">
  <h3><?php echo $ipa; ?></h3>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">> > > >   IP   < < < <</th>
 
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>


    <?php 
if (!$ipbs){
}  else {
    foreach($ipbs as $ipb)  { 
   $id = $ipb['id'];
   $uipb = $ipb['uipb'];
 
   $time = $ipb['time'];
   
   
   ?>
 <tr>
     
      <td><?php echo $id; ?></td>
      <td><?php echo $uipb; ?></td>
      <td><?php echo $time; ?></td>
    </tr>


<?php 
}}

?>


   
   
  </tbody>
</table>

</div>

<div class="box"></div>

















      

  <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-DBjhmceckmzwrnMMrjI7BvG2FmRuxQVaTfFYHgfnrdfqMhxKt445b7j3KBQLolRl"
    crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"
    integrity="sha384-EbSscX4STvYAC/DxHse8z5gEDaNiKAIGW+EpfzYTfQrgIlHywXXrM9SUIZ0BlyfF"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
    integrity="sha384-i+dHPTzZw7YVZOx9lbH5l6lP74sLRtMtwN2XjVqjf3uAGAREAF4LMIUDTWEVs4LI"
    crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>


  <script>
let imagein = document.getElementById('imge');

imagein.addEventListener('input', () => {
    autoClickButton();
})
// สร้างฟังก์ชันที่คลิกปุ่มโดยอัตโนมัติ
function autoClickButton() {

  var button = document.getElementById('submitxxx'); // เปลี่ยน 'myButton' เป็น ID ของปุ่มที่คุณต้องการคลิก

  if (button) {
    // ตรวจสอบว่าปุ่มมีอยู่จริง
    button.click(); // คลิกปุ่ม
  } else {
    console.log('ไม่พบปุ่ม'); // ถ้าไม่พบปุ่ม
  }
}

    
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>