<?php
define('TITLE', 'TABLE');
define('PAGE', 'table');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
$msg ="";
$tno = $_REQUEST['tableno'];
if(isset($_REQUEST['addtablle']))
{
  if($_REQUEST["tableno"] == "")
  {
    $msg = '<div class="text-uppercase text-danger">inser table number</div>';
  }
  else
  {
      
      
      $dupsql = "SELECT * from `table_available` where No = '$tno' "; 
      $dupchk = $conn->query($dupsql);

      if($dupchk->num_rows > 0)
      {
      $msg = '<div class="text-uppercase text-danger">Already exist</div>';
      }
      else
      {

      
        $sqldata = "INSERT INTO `table_available`(`No`) VALUE ('$tno')";
        $conn->query($sqldata);
        $msg =  '<div class="text-uppercase text-danger">Added succesfully</div>';
        
      }

  
  }
}


?>
<div class="page-content p-5 shadow-sm px-4" id="content">


<div class="mt-5 ">
<form class="form-inline" action="" method="POST">
  <div class="form-group mb-2">
  <div class="form-group mx-sm-3 mb-2">
    <input type="number" class="form-control" id="tableno" name="tableno" placeholder="Table Number">
  </div>
  <button type="submit" class="btn btn-primary mb-2" name="addtablle">Add table</button>
</form>

</div>


<?php
echo $msg; 
$sql = "SELECT * FROM table_available";

$DATA = $conn->query($sql);
echo '
<table class="table">
        <thead>
            <tr>
                
                <th scope="col">Available table No.</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>';
while( $row = $DATA->fetch_assoc()){
  echo '
            <tr>
                
                <th  scope="row">'.$row["No"].'</th>
                <td>
                <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["id"] .'><button type="submit" class="btn btn-danger" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form>
                </td>
            </tr>
        <tbody>';

}




if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM table_available WHERE id = {$_REQUEST['id']}";
  if($conn->query($sql) === TRUE){
    // echo "Record Deleted Successfully";
    // below code will refresh the page after deleting the record
    echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "Unable to Delete Data";
    }
  }
?>


</div> <!-- Main Content area End Middle -->

<?php 
  
  include('includes/footer.php'); 
  $conn->close();
?>