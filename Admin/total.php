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


 $query = "SELECT * FROM complete_order order by pid desc";
 $result = $conn->query($query);
?>



<div class="page-content p-5 " id="content">
  <div class="mt-5 text-center">
    <!--Table-->
    <p class=" bg-primary text-white p-2">MENU</p>

    <div class="row">
      <div class="input-daterange">
        <form class="form-inline">

          <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control mx-2" name="start_date" id="start_date" placeholder="From Date">

            <input type="text" class="form-control mx-2" name="end_date" id="end_date" placeholder="To Date">

            <input type="button" class="btn btn-primary mx-2" name="filter" value="Filter" id="filter" />
          </div>

        </form>

      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="table-responsive">
          <div id="totaltable">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">DOP</th>
                  <th scope="col">tableNo</th>
                  <th scope="col">Price</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
               while($row = $result->fetch_assoc()){
                echo '<tr>
        
                <td>'.$row["invoiceid"].'</td>
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
                  <button type="hidden" class="btn btn-danger"  name="pbill" value='.$row["pid"] .'>
                        <i class="fas fa-file-download">
                        </i> Download Bill</form>
                  </td>
              </tr>';
               }
              ?>

              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>


    <?php
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

<script>
  $(document).ready(function () {

    $.datepicker.setDefaults({
      dateFormat: 'yy-mm-dd'
    })
    $(function () {
      $("#start_date").datepicker();
      $("#end_date").datepicker();
    });

    $('#filter').click(function () {
      var start_date = $('#start_date').val();
      var end_date = $("#end_date").val();
      if (start_date != '' && end_date != '') {
        $.ajax({
          url: "api/totaldata.php",
          method: "POST",
          data: {
            start_date: start_date,
            end_date: end_date
          },
          success: function (data) {
            $('#totaltable').html(data);
          }
        });
      } else {
        alert("select a date");
      }
    });
  });
</script>