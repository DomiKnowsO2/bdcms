<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
// require_once('../../db-connect.php');
$mysqli = new mysqli("localhost", "root", "", "bdcmsdb");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$alertcount = "SELECT COUNT(*) AS PendingCount FROM requests_tb WHERE status = 'Pending'";
$result_Alert = $mysqli->query($alertcount);

if (!$result_Alert) {
    echo "Error executing query: " . $mysqli->error;
    exit();
}

$row_Alert = $result_Alert->fetch_assoc();
$Alert_Count = $row_Alert['PendingCount'];

$mysqli->close();
?>

<div class="col-auto col-md-3 col-xl-2  px-0 newbg">
    <div class="col-auto col-xl-2 position">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 position">
            <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-5 d-none d-sm-inline" style="justify-items:center;">Admin</span>
            </a>
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                <li class="nav-item">
                    <a href="./index.php?page=dashboard" class="nav-link align-middle px-0">
                        <i class="fa fa-tachometer-alt"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index.php" class="nav-link align-middle px-0">
                        <i class="fa fa-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                    </a>
                </li>
                <!--
                    <li>
                        <a href="../requests.php" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Requests</span> </a>
                            <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                            </li>
                        </ul>
                    </li>-->
                <li class="nav-item">
                    <a href="./index.php?page=requests" class="nav-link px-0 align-middle">
                        <i class="fa fa-envelope"></i>
                        <span class="ms-1 d-none d-sm-inline">Requests</span>
                        <span class="ms-5 spancount align-middle"><?php echo $Alert_Count; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index.php?page=patients_record" class="nav-link px-0 align-middle">
                        <i class="fa fa-user"></i> <span class="ms-1 d-none d-sm-inline">Patients Record</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index.php?page=history" class="nav-link px-0 align-middle">
                        <i class="fa fa-history"></i> <span class="ms-1 d-none d-sm-inline">History Record</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index.php?page=services" class="nav-link px-0 align-middle">
                        <i class="fa fa-cogs"></i> <span class="ms-1 d-none d-sm-inline">Services Record</span>
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown pb-4">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $link; ?>" alt="hugenerd" width="30" height="30" class="rounded-circle" style="overflow: hidden;background-size: cover;background-position: center;">
                    <span class="d-none d-sm-inline mx-1"> <?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <!--<li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>-->
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    .spancount {
        color: #fff;
        background-color: rgb(255, 0, 0);
        font-size: 0.9em;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: inline-flex;
        position: absolute;
        justify-content: center;
        align-items: center;
    }

    /* .spancounts {
        position: absolute;
        color: #fff;
        background-color: rgb(255, 0, 0);
        border-radius: 50%;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        right: 10px;
        font-size: 0.9em;
        width: 250px;
        height: 25px;
    } */

    .align-middle i {
        width: 30px;
    }

    .newbg {
        background: #222831;
        border-right: 2px solid #222831;
        -webkit-box-shadow: 0 0 18px -3px rgba(0, 0, 0, 0.65);
        box-shadow: 0 0 18px -3px rgba(0, 0, 0, 0.65);
    }

    .position {
        position: fixed;
        background: #222831;
        height: 100%;

    }

    .nav-item a {
        color: #fff;
    }
</style>