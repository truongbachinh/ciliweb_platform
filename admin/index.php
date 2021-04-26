<?php
include "../config_admin.php";
if (!isset($_SESSION['current_user'])) {
    header("location: ./account/login.php");
}

if (isset($_GET['view'])) {
    $t = $_GET['view'];
} else {
    $t = '';
}
$adminId = $_SESSION['current_user']['admin_id'];


$queryUser = $link->query("SELECT COUNT(user.user_id) as total_user_active FROM user WHERE user.user_role_id = 2 AND user.user_status = 1");
$totalUser = $queryUser->fetch_assoc();
$totalUserActive  = $totalUser['total_user_active'];


$queryShop = $link->query("SELECT COUNT(user.user_id) as total_shop_active FROM user INNER JOIN shop ON shop.shop_user_id = user.user_id WHERE user.user_role_id = 1 AND user.user_status = 1");
$totalShop = $queryShop->fetch_assoc();
$totalShopActive  = $totalShop['total_shop_active'];




$chartSearch = null;
if (isset($_POST["submitFieldChart"])) {
    $chartSearch = $_POST["chartField"];
}

$queryChart = null;

$top10Array = array();
$dataPoints = array();
if ($chartSearch != null) {
    if ($chartSearch  == "1") {
        $queryChart = ("SELECT COUNT(orders.id) as order_amount, orders.*, order_address.* from orders inner join order_address on order_address.oda_order_id = orders.id GROUP BY order_address.oda_city ORDER BY COUNT(orders.id) DESC LIMIT 10");
        $top10City = $link->query($queryChart);
        while ($rowTop = mysqli_fetch_array($top10City)) {
            $top10Array[] =  $rowTop;
        }
        foreach ($top10Array as $value) {
            list($dataPoints[])  = array(
                array("y" =>  $value['order_amount'], "label" => $value['oda_city']),
            );
        }
    } elseif ($chartSearch == '2') {

        $queryChart = ("SELECT COUNT(orders.id) as total_order_shop, shop.shop_name FROM orders INNER JOIN shop ON shop.shop_id = orders.order_shop_id GROUP BY orders.order_shop_id ORDER BY COUNT(orders.id) DESC LIMIT 10");
        $top10Shop = $link->query($queryChart);
        while ($rowTop = mysqli_fetch_array($top10Shop)) {
            $top10Array[] =  $rowTop;
        }
        foreach ($top10Array as $value) {
            list($dataPoints[])  = array(
                array("y" =>  $value['total_order_shop'], "label" => $value['shop_name']),
            );
        }
    } elseif ($chartSearch == '3') {

        $queryChart = ("SELECT COUNT(orders.id) as order_amount, user.fullname from orders INNER JOIN user ON user.user_id = orders.order_user_id inner join order_address on order_address.oda_order_id = orders.id GROUP BY orders.order_user_id ORDER BY COUNT(orders.id) DESC LIMIT 10");
        $top10User = $link->query($queryChart);
        while ($rowTop = mysqli_fetch_array($top10User)) {
            $top10Array[] =  $rowTop;
        }
        foreach ($top10Array as $value) {
            list($dataPoints[])  = array(
                array("y" =>  $value['order_amount'], "label" => $value['fullname']),
            );
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->
        <?php
        if ($t == 'changepassword') {
            include('../account/change_password.php');
        } else {

        ?>
            <section class="manage-page">
                <div class="container m-t-30">
                    <div class="row d-fex justify-content-lg-around">
                        <div class="col-lg-6 col-md-6">
                            <div class="card m-b-30 ">
                                <div class="card-body">
                                    <div>
                                        <div class="pb-2 text-center">
                                            <div class="avatar avatar-lg">
                                                <div class="avatar-title bg-soft-primary rounded-circle">
                                                    <i class="fe fe-users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="text-muted text-overline m-0 text-center">Total of Customer</h4>
                                        <h3 class="fw-400 text-center m-t-10">
                                            <?= $totalUserActive ?> Customer
                                        </h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="pb-2 text-center">
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-soft-primary rounded-circle">
                                                <i class="fe fe-home"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class=" text-center text-muted text-overline m-0">Total of Onine shop</h4>
                                        <h3 class="fw-400 text-center m-t-10"> <?= $totalShopActive ?></h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2 style="text-align:center"> Chart analysis </h2>
                                    </div>
                                </div>
                                <div class="row m-l-20">
                                    <div class="col-sm-6">
                                        <div class="form-group has-search">
                                            <form action="" method="POST">
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <select id="chartField" name="chartField" class="form-control">
                                                                <option value="" selected>-----Top 10 of-----</option>
                                                                <option value="1">Top 10 shopping areas</option>
                                                                <option value="3">Top 10 user </option>
                                                                <option value="2">Top 10 best selling shop </option>


                                                            </select>
                                                        </div>
                                                        <div class="search">
                                                            <input type="submit" name="submitFieldChart" id="submitFieldChart" value="Search" class="btn btn-info">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5>Top 10 of <?php
                                                    if (!empty($top10Shop)) {
                                                    ?>
                                            <span> best selling shop</span>
                                        <?php
                                                    } elseif (!empty($top10User)) {
                                        ?>
                                            <span>best buying user </span>
                                        <?php
                                                    } elseif (!empty($top10City)) {
                                        ?>
                                            <span>shopping areas</span>
                                        <?php
                                                    }
                                        ?>
                                    </h5>
                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        <?php

        }


        ?>

        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {

        })
    </script>
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Cili web"
                },
                axisY: {
                    title: "Total "
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## ",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]

            });
            chart.render();
        }
    </script>
</body>

</html>