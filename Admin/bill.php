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
    // genrete invoice id

    $query = "SELECT `invoiceid` from `complete_order` ORDER BY `invoiceid` desc";
    $res = $conn->query($query);

    $rw = $res->fetch_array();
    $lastid = $rw["invoiceid"];

    if(empty($lastid))
    {
        $number = "LNC-00000001";
    }
    else
    {
        $idd = str_replace("LNC-","",$lastid);
        $id = str_pad($idd + 1 , 7,0, STR_PAD_LEFT);
        $number = 'LNC-' . $id;
    }

 if(isset($_POST['pupdate'])){

  $tid = $_REQUEST['tid'];

  $ordid = $_REQUEST['ordid'];

  $dop = $_REQUEST['pdop'];
  $mrp = $_REQUEST['mrp'];
  $ItmJSN = $_REQUEST['itemjson'];

  $sql = "INSERT INTO `complete_order`(`invoiceid`, `pdop`,`pitems`,`tableno`, `totalbill`) VALUES ('$ordid','$dop','$ItmJSN','$tid','$mrp')";
  if($conn->query($sql) == true)
  {
   
      $sql_del = "DELETE FROM `orders_tb` WHERE tableno = '{$tid}'";
      $conn->query($sql_del);
      $msg = "ORDER CONFIRMED";
      header("Location: total.php"); 
    }
     
  
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
        <?php echo '<div class="text-danger text-center">'.$msg.'</div>'; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="pid">Table NO</label>
                
                <input
                    type="text"
                    class="form-control"
                    id="pid"
                    name="tid"
                    value="<?php if(isset($row['tableno'])) {echo $row['tableno']; }?>"
                    readonly="readonly">
            </div>

            <div class="form-group">
                <label for="pname">Order ID </label>
                <input type="text" class="form-control" id="ordid" name="ordid" value="<?php echo $number; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="pdop">DOP</label>
                <input
                    type="date"
                    class="form-control"
                    id="pdop"
                    name="pdop" >
            </div>
            <div class="form-group ">
                <label for="poriginalcost">MRP
                </label>
                <input
                    readonly="readonly"
                    type="text"
                    class="form-control"
                    id="poriginalcost"
                    name="mrp"
                    value="<?php if(isset($row['totalbill'])) {echo $row['totalbill']; }?>">
            </div>
            
            <div class="form-group ">
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <th>ITEM</th>
                        <th>PRICE</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody>
            <?php
            $sql2 = "SELECT *  FROM orders_tb WHERE tableno = {$_REQUEST["id"]}";
            $DATA2 = $conn->query($sql2);
            while($row2 = $DATA2->fetch_assoc() ){
            echo '<tr>
            <td scope="row" name="itemname"> '.$row2["pname"].'</td>
            <td name="sellingprice"> '.$row2["psellingcost"].'</td>
            <td name="pqantity"> '.$row2["pqty"].'</td>
            </tr>';
            ;
          }
            ?>

                    </tbody>
                </table>
            </div>
            <input type="hidden" name="itemjson" id="itm" value="">
            <div class="text-center">
            <input type="submit" class="btn btn-success" id="pupdate" name="pupdate" onclick="swaltrigger()" value="CONFIRM ORDER">
             <a href="orders.php" class="btn btn-danger">CANCEL</a>
            </div>
          
           
            <?php if(isset($msg)) {echo $msg; } ?>
        </form>
    </div>
    
    <?php

?>

</div>

<?php
include('includes/footer.php'); 
?>
<!-- store items details as array to help genrate bill or fetch as table -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
   <script>
    var array = [];
    var headers = [];
    $('#dataTable th').each(function(index, item) {
        headers[index] = $(item).html();
    });
    $('#dataTable tr').has('td').each(function() {
        var arrayItem = {};
        $('td', $(this)).each(function(index, item) {
            arrayItem[headers[index]] = $(item).html();
        });
        array.push(arrayItem);
    });

    itemdetails  = JSON.stringify(array);
    
    document.getElementById("itm").value = itemdetails;
    

    // set auto date
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#pdop").value = today;
</script>