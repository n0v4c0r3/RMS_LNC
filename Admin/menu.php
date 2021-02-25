<?php
define('TITLE', 'Menu');
define('PAGE', 'menu');
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
    $sql = "SELECT * FROM menu_tb order by id desc";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
  echo '<table class="table">
    <thead>
      <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Name</th>
        <th scope="col">DOP</th>
      
        <th scope="col">Price</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>';
    while($row = $result->fetch_assoc()){
      echo '<tr>
        <th scope="row">'.$row["id"].'</th>
        <td>'.$row["pname"].'</td>
        <td>'.$row["pdop"].'</td>
        
        <td>'.$row["poriginalcost"].'</td>

        <td>
          <form action="editmenuitem.php" method="POST" class="d-inline"> 
          <input type="hidden" name="id" value='. $row["id"] .'>
          <button type="submit" class="btn btn-info" name="view" value="View">
          <i class="fas fa-pen"></i>
          </button>
          </form>  

          <form action="" method="POST" class="d-inline">
          <input type="hidden" name="id" value='. $row["id"] .'>
          <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
          <i class="far fa-trash-alt"></i>
          </button>
          </form>

          </td>
      </tr>';
    }
    echo '</tbody>
  </table>';
  } else {
    echo "0 Result";
  }
  if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM menu_tb WHERE id = {$_REQUEST['id']}";
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
  <div>
  <a class="btn btn-primary box float-right" href="addmenuitem.php">
      <i class="fas fa-plus fa-2x"></i>
  </a>
  </div>

</div>


<?php
include('includes/footer.php'); 
?>