<!DOCTYPE html>
<?php 
error_reporting(0);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LN CAFE </title>
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/custom1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>

<body>



    <nav class="navbar shadow py-3 fixed-top navbar-light bg-light">
        <a href="#" class="">LATE NIGHT CAFE</a>
        <i class="fa fa-bars fa-2x text-primary " id="menu-toggle"></i>
    </nav>


    <!-- sidebar -->

    <div class="vertical-nav bg-white" id="sidebar">

        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center">
                <div class="media-body">
                    <h4 class="m-0">ADMIN</h4>
                </div>
            </div>
        </div>

        <p href="#" class="text-grey font-weight-bold text-uppercase px-3 small pb-4 mb-0">ADMIN MANAGEMENT
        </p>

        <ul class="nav flex-column bg-white mb-0 p-3">


            <li class="nav-item py-3">
                <a href="dashboard.php" class="nav-link text-dark  <?php if(PAGE == 'dashboard') { echo 'active'; } ?>">
                    <i class="fa fa-bars mr-3 text-primary fa-fw" aria-hidden="true"></i>
                    DASHBOARD
                </a>
            </li>
            <li class="nav-item py-3 <?php if(PAGE == 'orders') { echo 'active'; } ?>">
                <a href="orders.php" class="nav-link text-dark">
                    <i class="fa fa-file-invoice mr-3 text-primary fa-fw" aria-hidden="true"></i>
                    ORDERS
                </a>
            </li>
            <li class="nav-item py-3 <?php if(PAGE == 'table') { echo 'active'; } ?>">
                <a href="table.php" class="nav-link text-dark">
                    <i class="fas fa-chair mr-3 text-primary fa-fw" aria-hidden="true"></i>
                    TABLE
                </a>
            </li>

            <li class="nav-item py-3 <?php if(PAGE == 'menu') { echo 'active'; } ?>">
                <a href="menu.php" class="nav-link text-dark">
                    <i class="fa fa-book mr-3 text-primary fa-fw" aria-hidden="true"></i>
                    MENU
                </a>
            </li>
            <li class="nav-item py-3 <?php if(PAGE == 'totalorder') { echo 'active'; } ?>">
                <a href="total.php" class="nav-link text-dark">
                    <i class="fa fa-download mr-3 text-primary fa-fw"></i>
                    Bill
                </a>
            </li>
            <li class="nav-item py-3 <?php if(PAGE == 'staff') { echo 'active'; } ?>">
                <a href="staff.php" class="nav-link text-dark">
                    <i class="fa fa-users mr-3 text-primary fa-fw"></i>
                    STAFF MEMBERS
                </a>
            </li>

            <li class="nav-item py-3 <?php if(PAGE == 'changepass') { echo 'active'; } ?>">
                <a href="changepass.php" class="nav-link text-dark">
                    <i class="fa fa-key mr-3 text-primary fa-fw" aria-hidden="true"></i>
                    CHANGE PASSWORD
                </a>
            </li>

            <li class="nav-item py-3">
                <a href="../logout.php" class="nav-link text-dark">
                    <i class="fa fa-sign-out-alt mr-3 text-primary fa-fw" aria-hidden="true"></i>
                    LOGOUT
                </a>
            </li>

        </ul>

    </div>