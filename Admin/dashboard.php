<?php
define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 $sql = "SELECT count(pid) FROM complete_order";
 $result = $conn->query($sql);
 $row = mysqli_fetch_row($result);
 $torders = $row[0];

 $sql = "SELECT sum(totalbill) FROM complete_order";
 $result = $conn->query($sql);
 $row = mysqli_fetch_row($result);

 $revnue = $row[0];

 $sql = "SELECT * FROM staff_tb";
 $result = $conn->query($sql);
 $emplpye = $result->num_rows;

 $sql = "SELECT pid,pdop FROM complete_order ORDER BY pid";
 $result = $conn->query($sql);
 
 $datareturn = array();
 foreach ($result as $row){
     $datareturn[] =$row;
 }

//  print json_encode($datareturn);

?>
<div class="page-content p-5 shadow-sm px-4" id="content">
    <div class="row mx-5 text-center">
        <div class="col-sm-4 mt-5">
            <div
                class="card text-white bg-success mb-3"
                style="max-width: 18rem; border-radius:5px; border: 0; background: rgb(119,96,150);
background: linear-gradient(to left bottom, #00e75c, #00ed55, #00f34d, #00f943, #00ff37);">
                <div class="card-header">TOTAL ORDERS</div>
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo $torders; ?>
                    </h4>
                    <a class="btn text-white" href="total.php">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div
                class="card text-white bg-dark mb-3"
                style="max-width: 18rem; border-radius:5px; border: 0; background: rgb(64,65,255);
background:  linear-gradient(to right top, #163eff, #4239fd, #5a33fa, #6d2bf7, #7d22f4);">
                <div class="card-header">Total Revenue</div>
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo $revnue; ?>
                    </h4>
                    <a class="btn text-white" href="#bar-graph">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div
                class="card text-white bg-primary mb-3"
                style="max-width: 18rem;  border-radius:5px; border: 0; background: rgb(213,0,240);
background: linear-gradient(90deg, rgba(213,0,240,1) 0%, rgba(166,0,255,1) 100%);">
                <div class="card-header">No. of Employee</div>
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo $emplpye; ?>
                    </h4>
                    <a class="btn text-white" href="staff.php">View</a>
                </div>
            </div>
        </div>
    </div>
    
            <canvas id="bar-graph"  style=" width:auto; max-height:720px;"></canvas>
       
</div>


<?php
include('includes/footer.php'); 
?>
<script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
    integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
    crossorigin="anonymous"></script>
</script>
<script src="../js/chartdata.js"></script>