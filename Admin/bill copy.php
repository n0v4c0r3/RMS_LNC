<?php
define('TITLE', 'Billing');
define('PAGE', 'billing');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }

 if(isset($_REQUEST['pbuy'])){
   $tid = $_REQUEST['tid'];
   $cname = $_REQUEST['Bname'];
   $dop = $_REQUEST['pdop'];
   $itm= $_REQUEST['tid'];
   $mrp = $_REQUEST['mep'];

   $sq = "INSERT INTO `complete_order`(`pname`, `pdop`, `tableno`, `totalbill`) VALUES ('$Bname', '$pdop,'$tid','$mrp')";
   $conn->query($sq);
  

 }
?>

<div class="page-content p-5 " id="content">

<?php

if(isset($_REQUEST['id'])){
  $sql = "SELECT * , SUM(psum) as totalbill FROM orders_tb WHERE tableno = {$_REQUEST["id"]}";
  
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

}
?> 
<div class="mt-5">
<h3 class="text-primary text-center text-bold ">BILLING & CONFIRM ORDER</h3>
<form action="" method="POST">
    <div class="form-group">
        <label for="pid">TAble NO</label>
        <input
            type="text"
            class="form-control"
            id="pid"
            name="tid"
            value="<?php if(isset($row['tableno'])) {echo $row['tableno']; }?>"
            readonly="readonly">
    </div>
    
   
    <div class="form-group">
        <label for="pname">Buyers Name</label>
        <input
            type="text"
            class="form-control"
            id="pname"
            name="Bname"
            value="">
    </div>

    <div class="form-group">
        <label for="pdop">DOP</label>
        <input
            type="date"
            class="form-control"
            id="pdop"
            name="pdop"
            value="<?php if(isset($row['pdop'])) {echo $row['pdop']; }?>">
    </div>

    <div class="form-group ">
        <table class="table table-striped ">
          <thead>
            <th>ITEM NAME</th>
            <th>PRICE EACH</th>
            <th>Quantity</th>
          </thead>
          <tbody>
            <?php
            $sql2 = "SELECT *  FROM orders_tb WHERE tableno = {$_REQUEST["id"]}";
            $DATA2 = $conn->query($sql2);
            while($row2 = $DATA2->fetch_assoc() ){
            echo '<tr>
            <th scope="row"> '.$row2["pname"].'</th>
            <td> '.$row2["psellingcost"].'</td>
            <td> '.$row2["pqty"].'</td>
            </tr>';
            ;
          }
            ?>
          </tbody>
        </table>
    </div>



    <div class="form-group ">
        <label for="poriginalcost">MRP
        </label>
        <input
        readonly
            type="text"
            class="form-control"
            id="poriginalcost"
            name="mrp"
            value="<?php if(isset($row['totalbill'])) {echo $row['totalbill']; }?>">
    </div>
    <div class="text-center">
        <button onclick="swclick()" type="submit" class="btn btn-success" id="pupdate" name="pbuy">CONFIRM ORDER</button>
        <a href="orders.php" class="btn btn-danger">CANCEL</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
</form>
</div>
<?php

?>


</div>

        
<script>
  function swclick(){
  <?php echo $msg?>
</script>
<?php
include('includes/footer.php'); 
?>