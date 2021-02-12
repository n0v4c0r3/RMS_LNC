<?php
error_reporting(0);
define('TITLE', 'ORDERS');
define('PAGE', 'orders');
include('includes/header.php');
include('../dbConnection.php'); 
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>

<div class="page-content p-5" id="content">
  <div class="py-5">
    <a class="btn btn-primary box px-3" href="addorder.php">
      <i class="fas fa-plus"></i> ADD ORDERS</a>
  </div>

  <?php
 $sql = "SELECT * FROM table_available";
 $result = $conn->query($sql);

 while($tb = $result->fetch_assoc()){
   ?>
  <p class=" bg-primary text-white p-2 mt-3 shadow rounded odr">Orders for TABLE <?php echo $tb['No']; ?></p>
  <div class="card">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Name</th>
        <th scope="col">DOP</th>
        <th scope="col">price Each</th>
        <th scope="col">Quantity</th>
        <th scope="col">Total</th>
        <th scope="col">Action</th>
      </tr>
    </thead>

    <tbody>

      <?php

        $sql2 = "SELECT * FROM orders_tb where tableno = '{$tb['No']}'";
        $DATA = $conn->query($sql2);

        while( $row = $DATA->fetch_assoc())
        {
          echo
        '<tr>
                <th scope="row">'.$row["pid"].'</th>
                <td>'.$row["pname"].'</td>
                <td>'.$row["pdop"].'</td>
                <td>'.$row["psellingcost"].'</td>
                <td>'.$row["pqty"].'</td>
                <td>'.$row["psum"].'</td>
                <td>
                <form action="editorders.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["pid"] .'><button type="submit" class="btn btn-info" name="view" value="View"><i class="fas fa-pen"></i></button></form>  
                <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["pid"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form>
                </td>
                
        </tr>';
        }

        // bill setion

        echo '
        
        <table class="table table-striped mt-1 mb-5">
        <p class=" bg-dark text-white p-2">BILLING</p>
        <thead>
            <tr>
                <th scope="col">TABLE NO</th>
                <th scope="col">DOP</th>
                <th scope="col">Total</th>
                <th scope="col">Confirm </th>
            </tr>
        </thead>
        <tbody>';
        $Store = $tb['No'] ;
        $sql3 = "SELECT * FROM orders_tb where tableno = '$Store'";
        $DATA2 = $conn->query($sql3);
        $bil = $DATA2->fetch_assoc();
        
        ?>
      <tr>
        <th scope="row"><?php echo $bil['tableno']; ?></th>
        <td><?php echo $bil['pdop'] ?></td>

        <td>

          <?php 
                
                $sq = "SELECT SUM(psum) as totalbill FROM orders_tb where tableno = '{$tb['No']}'";
                $sum = $conn->query($sq);
                $returnsum = mysqli_fetch_array($sum);
                $mrp = $returnsum['totalbill'];

                echo $mrp;
               
                ?>

        </td>

        <td>

          <?php
                echo '
                <form action="bill.php" method="POST" class="d-inline">
                
                <button type="hidden" class="btn btn-success px-5"  name="id" value='.$bil["tableno"] .'>
                <i class="fas fa-cart-arrow-down">
                </i>
              
                </form>';
                ?>

        </td>
      </tr>

      <?php
      ?>
    </tbody>
  </table>
  </div> <?php
    ?>
    

  <?php 
  
      }

    if(isset($_REQUEST['delete'])){
      $sql = "DELETE FROM orders_tb WHERE pid = {$_REQUEST['id']}";
      if($conn->query($sql) === TRUE){
        // echo "Record Deleted Successfully";
        // below code will refresh the page after deleting the record
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
        } else {
          echo "Unable to Delete Data";
        }
      }

      
?>

</div>
<?php
include('includes/footer.php'); 
?>