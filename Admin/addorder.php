<?php
define('TITLE', 'Add New Product');
define('PAGE', 'assets');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
if(isset($_REQUEST['psubmit'])){
 // Checking for Empty Fields
 if(($_REQUEST['pname'] == "") || ($_REQUEST['pdop'] == "") || ($_REQUEST['pqty'] == "") || ($_REQUEST['tableno'] == "")){
  // msg displayed if required field missing
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {
  // Assigning User Values to Variable
  $pname = $_REQUEST['pname'];
  $pdop = $_REQUEST['pdop'];
  $pqty = $_REQUEST['pqty'];
  $tableN = $_REQUEST['tableno'];
  $psellingcost = $_REQUEST['psellingcost'];
  
  
  $sql_price =  "SELECT * from menu_tb where pname = '{$pname}'";
  $data = $conn->query($sql_price);
  $price_data = $data->fetch_assoc();
  $price = $price_data["poriginalcost"];

  $psum = $pqty*$price;

   $sql = "INSERT INTO `orders_tb`( `pname`, `pdop`, `pqty`, `tableno`, `psellingcost`, `psum`) VALUES ('$pname', '$pdop', '$pqty' , '$tableN', '$price',  '$psum' )";
   
  

   if($conn->query($sql) == TRUE){
    // below msg display on form submit success
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Added Successfully </div>';
   } else {
    // below msg display on form submit failed
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add </div>';
   }
 }
 }
?>
<div class="page-content p-5 mt-5" id="content">
  <h3 class="text-center">Add New Product</h3>
  <form action="" method="POST">

    <div class="form-group">
      <!-- <label for="pname">item Name</label> -->
      <!-- <input type="text" class="form-control" id="pname" name="pname"> -->
      <select id="pname" name="pname">
        <?php  
        $itemsql = "select * from `menu_tb`";
        $data = $conn->query($itemsql);
        while($row = $data->fetch_assoc()){
        echo '<option name="itm">'. $row["pname"].'</option>'; 
        } 
        ?>
      </select>
      
    </div>

    <div class="form-group">
      <label for="pdop">Date of Purchase</label>
      <input type="date" class="form-control" id="pdop" name="pdop">
    </div>
    <div class="form-group">
      <label for="pqty">quantity</label>
      <input type="text" class="form-control" id="pqty" name="pqty" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="poriginalcost">Table No</label><br>
      <!-- <input type="text" class="form-control" id="tableno" name="tableno" onkeypress="isInputNumber(event)"> -->
      <select id="pname" name="tableno">
        <?php  
        $itemsql = "select * from `table_available`";
        $data = $conn->query($itemsql);
        while($row = $data->fetch_assoc()){
          echo '<option>'. $row["No"].'</option>';
        }
        ?>
      </select>
    </div>
    
  <div class="text-center">
    <button type="submit" class="btn btn-success px-5" id="psubmit" name="psubmit">Add Food</button>
    <a href="orders.php" class="btn btn-primary">BACK TO ORDERS</a>
  </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Only Number for input fields -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }

//sum
  $(function(){
            $('#pqty, #psellingcost').keyup(function(){
               var value1 = parseFloat($('#pqty').val()) || 0;
               var value2 = parseFloat($('#psellingcost').val()) || 0;
               $('#ptotalcost').val(value1 * value2);
            });
         });


         document.getElementById('pdop').valueAsDate = new Date();
</script>
<?php
include('includes/footer.php'); 
?>