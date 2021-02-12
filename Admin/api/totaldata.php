<?Php 

if(isset($_POST["start_date"], $_POST["end_date"]))
{
    include ('../../dbConnection.php');
    $output = '';
    $query = "SELECT * from complete_order where pdop BETWEEN '".$_POST["start_date"]. "' AND '".$_POST["end_date"]."'";
    $result = $conn->query($query);

    $output .= '
    <table class="table">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">DOP</th>
                  <th scope="col">tableNo</th>
                  <th scope="col">Price</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
    ';
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_array())
        {
            $output .= '
            <tr>
        
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
              </tr>
            ';
        }
    }
    else
    {
        $output .= '
        <tr>
        <td colspan="5">No Bill Found</td>
        </tr>
        ';
    }
    $output .= '
    </tbody>
    </table>';
    echo $output;
}

?>
