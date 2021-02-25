<!DOCTYPE html>
<?php
include('../dbConnection.php');

if(isset($_POST['pbill']))
{
    
    $sql = "SELECT * FROM `complete_order` WHERE pid = {$_REQUEST['pbill']}";
    $result = $conn->query($sql);
    
    while($row = $result->fetch_array())
    {

    $Json_item = $row["pitems"];
    $subtotal = $row["totalbill"];
    $bname = $row["invoiceid"];
    $dop = $row["pdop"];
    $tno = $row["tableno"];
     

    }

    $decode_simple = json_decode($Json_item,true);


}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class="col-md-12 text-right mb-3 mt-5 ">

                    <div class="col-md-12 text-right">
                        <a href="dashboard.php" value="" class="btn btn-success"><i class="fa fa-home" aria-hidden="true"></i> HOME</a>
                        <button class="btn btn-primary" id="download"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
                        
                    </div>
                   
                </div>
            </div>
        </div>

        <!-- pdf -->

        <div class="container" id="invoice">

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0 ">
                            <div class="row py-2 px-3">
                                <div class="col-md-6">
                                    <p class="text-dark font-weight-bold">LATE NIGHT CAFE</p>
                                </div>

                                <div class="col-md-6 text-right">
                                    <p class="font-weight-bold ">Invoice #<?php echo $bname; ?></p>
                                    <p class="text-muted">Date:
                                        <?php echo $dop; ?></p>
                                </div>
                            </div>

                            <hr class="my-5">

                            <div class="row pb-0 px-3">
                                <div class="col-md-6">
                                    <p class="mb-1 font-weight-bold">Table No:
                                        <?php echo $tno; ?></p>

                                </div>

                            </div>

                            <div class="row p-2">
                                <div class="col-md-12">
                                    <!-- table -->
                                    <table class="table ">
                                        <tr>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>price
                                            </th>
                                            <th>total</th>
                                        </tr>

                                        <?php
                                        foreach($decode_simple as $jsondata){
            
                                     ?>
                                        <tr>
                                            <td><?php echo $jsondata["ITEM"]; ?></td>
                                            <td><?php echo $jsondata["Quantity"];?></td>
                                            <td><?php echo $jsondata["PRICE"];?></td>
                                            <td><?php echo $jsondata["Quantity"]*$jsondata["PRICE"]; ?></td>
                                        </tr>
                                        <?php
                                    } 
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <th>subtotal</th>
                                            <th><?php echo $subtotal;?></th>

                                        </tr>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- av -->
        <script>
            window.onload = function () {
                document
                    .getElementById("download")
                    .addEventListener("click", () => {
                        const invoice = this
                            .document
                            .getElementById("invoice");
                        console.log(invoice);
                        console.log(window);

                        var opt = 
                            {
                            margin: 0,
                            filename: 'LncInvoice00.pdf',
                            image: {
                                type: 'jpeg',
                                quality: 1
                            },
                            html2canvas: 
                            {
                                scale: 1
                            },
                            jsPDF: 
                            {
                                unit: 'mm',
                                format: 'a4',
                                orientation: 'portrait'
                            }
                        };
                        html2pdf()
                            .from(invoice).set(opt).save();
                    })
            }
        </script>

        <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    </body>
</html>