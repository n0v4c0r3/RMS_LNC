<?php
define('TITLE', 'totalorder');
define('PAGE', 'totalorder');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>

<div class="page-content p-5 " id="content">
    <div class="mt-5 text-center">
        <!--Table-->
        <p class=" bg-primary text-white p-2">MENU</p>
    <?php
    $sql = "SELECT * FROM complete_order order by pid desc ";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
  echo '<table class="table">
    <thead>
      <tr>
        
        <th scope="col">Name</th>
        <th scope="col">DOP</th>
        <th scope="col">tableNo</th>
        <th scope="col">Price</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>';
    while($row = $result->fetch_assoc()){
      echo '<tr>
        
        <td>'.$row["bname"].'</td>
        <td>'.$row["pdop"].'</td>
        <td>'.$row["tableno"].'</td>
        <td>'.$row["totalbill"].'</td>

        <td>
          <form action="" method="POST" class="d-inline">
          <input type="hidden" name="id" value='. $row["pid"] .'>
          <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
          <i class="far fa-trash-alt"></i>
          </button>
          </form>

          <form action="invoice.php" class="d-inline" method="POST">
          <button type="hidden" class="btn btn-success"  name="pbill" value='.$row["pid"] .'>
                <i class="fas fa-handshake">
                </i></form>
          </td>
      </tr>';
    }
    echo '</tbody>
  </table>';
  } else {
    echo "0 Result";
  }
  if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM complete_order WHERE pid = {$_REQUEST['id']}";
   
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

</div>

<?php
// bill generate pdf
include('includes/footer.php'); 
?>