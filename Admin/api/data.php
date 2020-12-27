<?Php 
header('Content-Type: application/json');

include ('../../dbConnection.php');


//print data as json format to render in chart js canvas

$sql = "SELECT pid , MONTHNAME(pdop)as month, sum(totalbill)as totalbill  FROM complete_order group BY month(pdop)";
$result = $conn->query($sql);

$data = array();
foreach ($result as $row){
    $data[] =$row;
}

$result->close();
$conn->close();

print json_encode($data);

?>
