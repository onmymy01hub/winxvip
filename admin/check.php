<?php
  session_start();
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
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>


    <?php 
if (!$ipas){
}  else {
    foreach($ipas as $ipa)  { 
   $id = $ipa['id'];
   $uipa = $ipa['uipa'];
   $time = $ipa['time'];
   
   
   ?>
 <tr>
      <th scope="row">1</th>
      <td><?php echo $id; ?></td>
      <td><?php echo $uipa; ?></td>
      <td>@<?php echo $time; ?></td>
    </tr>


<?php 
}}

?>


   
   
  </tbody>
</table>

</div>

