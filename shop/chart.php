<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
if (!isset($_SESSION['current_user'])) {
    header("location: ../account/login.php");
}



$queryTotalOrder = ("SELECT COUNT(orders.id) as order_amount, orders.*, order_address.*,user.* from orders
INNER JOIN user ON user.user_id = orders.order_user_id
inner join order_address on order_address.oda_order_id = orders.id
where orders.order_shop_id = $shopId GROUP BY orders.order_user_id ORDER BY COUNT(orders.id)");
$sumOrder = $link->query($queryTotalOrder);
$sumOrderArray = array();
while ($rowOrder = mysqli_fetch_array($sumOrder)) {
    $sumOrderArray[] =  $rowOrder;
}

$totalOrder = 0;
$otalUser = 0;
$sumUser = array();
foreach ($sumOrderArray as $sumOrderValue) {
    $sum = $sumOrderValue['order_amount'];
    $sumUser[] = ($sumOrderValue['order_amount']);

    $totalOrder += $sum;
}
if (!empty($queryTotalOrder)) {
    $totalUser = (COUNT($sumUser));
}


$queryOrderReice = $link->query("SELECT COUNT(orders.id) as order_receive_amount FROM orders where orders.order_shop_id = $shopId AND orders.shipping_order_status = 3");
$totalOrderR = mysqli_fetch_assoc($queryOrderReice);
$totalOrdeReceive = $totalOrderR['order_receive_amount'];

$queryOrderShiped = $link->query("SELECT COUNT(orders.id) as order_shiped_amount FROM orders where orders.order_shop_id = $shopId AND orders.shipping_order_status = 2");
$totalOrderS = mysqli_fetch_assoc($queryOrderShiped);
$totalOrdeShiped  = $totalOrderS['order_shiped_amount'];

$queryOrderCancle = $link->query("SELECT COUNT(orders.id) as order_cancle_amount FROM orders where orders.order_shop_id = $shopId AND orders.shipping_order_status = 4");
$totalOrderC = mysqli_fetch_assoc($queryOrderCancle);
$totalOrdeCancle  = $totalOrderC['order_cancle_amount'];

$queryOrderNotShip = $link->query("SELECT COUNT(orders.id) as order_not_ship_amount FROM orders where orders.order_shop_id = $shopId AND orders.shipping_order_status = 1");
$totalOrderNS = mysqli_fetch_assoc($queryOrderNotShip);
$totalOrdeNotShip   = $totalOrderNS['order_not_ship_amount'];


$sumOrderPieChart = 0;
$sumOrderPieChart = $totalOrdeReceive + $totalOrdeCancle;
if ($sumOrderPieChart != 0) {
    $dataPiePoints = array(
        array("label" => "Received", "y" => ($totalOrdeReceive / $sumOrderPieChart * 100)),
        array("label" => "Cancle", "y" => ($totalOrdeCancle / $sumOrderPieChart * 100)),

    );
}



$limit = '';
$chartSearch = null;
$queryChart = null;
if (isset($_POST["submitFieldChart"])) {

    $chartSearch = $_POST["chartField"];
    $limit = " LIMIT " .  $_POST["chartLimit"];



    $top10Array = array();
    $dataPoints = array();
    if ($chartSearch != null) {
        if ($chartSearch  == "chartUser") {
            $queryChart = ("SELECT COUNT(orders.id) as order_amount, orders.*, order_address.*,user.* from orders INNER JOIN user ON user.user_id = orders.order_user_id inner join order_address on order_address.oda_order_id = orders.id where orders.order_shop_id = $shopId GROUP BY orders.order_user_id ORDER BY COUNT(orders.id) DESC" . $limit);
            $top10User = $link->query($queryChart);
            while ($rowTop = mysqli_fetch_array($top10User)) {
                $top10Array[] =  $rowTop;
            }

            foreach ($top10Array as $value) {
                list($dataPoints[])  = array(
                    array("y" =>  $value['order_amount'], "label" => $value['fullname']),
                );
            }
        } elseif ($chartSearch  == "chartCity") {
            $queryChart = ("SELECT COUNT(orders.id) as order_amount, orders.*, order_address.* from orders inner join order_address on order_address.oda_order_id = orders.id where orders.order_shop_id = $shopId GROUP BY order_address.oda_city ORDER BY COUNT(orders.id) DESC LIMIT 10");
            $top10City = $link->query($queryChart);
            while ($rowTop = mysqli_fetch_array($top10City)) {
                $top10Array[] =  $rowTop;
            }

            foreach ($top10Array as $value) {
                list($dataPoints[])  = array(
                    array("y" =>  $value['order_amount'], "label" => $value['oda_city']),
                );
            }
        } elseif ($chartSearch == "chartProduct") {
            $queryChart = ("SELECT order_items.*, COUNT(order_items.order_product_id) as order_product_count, orders.*, products.p_name FROM `order_items` INNER JOIN products ON products.p_id = order_items.order_product_id INNER JOIN orders ON orders.id = order_items.order_id WHERE orders.order_shop_id = $shopId GROUP BY order_items.order_product_id ORDER BY COUNT(order_items.order_product_id) DESC" . $limit);
            $top10Product = $link->query($queryChart);
            while ($rowTop = mysqli_fetch_array($top10Product)) {
                $top10Array[] =  $rowTop;
            }

            foreach ($top10Array as $value) {
                list($dataPoints[])  = array(
                    array("y" =>  $value['order_product_count'], "label" => $value['p_name']),
                );
            }
        }
    }
} else {
    $queryChart = ("SELECT COUNT(orders.id) as order_amount, orders.*, order_address.*,user.* from orders INNER JOIN user ON user.user_id = orders.order_user_id inner join order_address on order_address.oda_order_id = orders.id where orders.order_shop_id = $shopId GROUP BY orders.order_user_id ORDER BY COUNT(orders.id) DESC LIMIT 3");
    $top10User = $link->query($queryChart);
    while ($rowTop = mysqli_fetch_array($top10User)) {
        $top10Array[] =  $rowTop;
    }
    if (!empty($top10Array)) {


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
    <?php include "../partials/aside_shop.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header_shop.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->

        <section class="manage-topic">
            <div class="container m-t-30">
                <div class="row d-fex justify-content-lg-between">
                    <div class="col-lg-2 col-md-6">
                        <div class="card m-b-30 ">
                            <div class="card-body">
                                <div class="pb-2 text-center">
                                    <div class="avatar avatar-lg">
                                        <div class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="fe fe-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-muted text-overline m-0 text-center">Total of user has order product</p>
                                    <h3 class="fw-400 text-center m-t-10">
                                        <?= $totalUser ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="pb-2 text-center">
                                    <div class="avatar avatar-lg">
                                        <div class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="fe fe-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class=" text-center text-muted text-overline m-0">Total of orders has confirm</p>
                                    <h3 class="fw-400 text-center m-t-10"> <?= $totalOrder ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="pb-2 text-center">
                                    <div class="avatar avatar-lg">
                                        <div class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="fe fe-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-muted text-overline m-0 text-center">Total of orders not shipped </p>
                                    <h3 class="fw-400 text-center m-t-10"><?= $totalOrdeNotShip ?> </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="pb-2 text-center">
                                    <div class="avatar avatar-lg">
                                        <div class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="fe fe-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-muted text-overline m-0 text-center">Total of orders shipped</p>
                                    <h3 class="fw-400 text-center m-t-10"> <?= $totalOrdeShiped ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="pb-2 text-center">
                                    <div class="avatar avatar-lg">
                                        <div class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="fe fe-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-center text-muted text-overline m-0">Total of orders receive</p>
                                    <h3 class="text-center fw-400 m-t-10"> <?= $totalOrdeReceive ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="pb-2 text-center">
                                    <div class="avatar avatar-lg">
                                        <div class="avatar-title bg-soft-primary rounded-circle">
                                            <i class="fe fe-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-muted text-overline m-0 text-center">Total of ordes cancle</p>
                                    <h3 class="fw-400 text-center m-t-10"><?= $totalOrdeCancle ?> </h3>
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
                                                    <div class="col-md-3 mb-3">
                                                        <select id="chartLimit" name="chartLimit" class="form-control">
                                                            <option value="3">Top 3</option>
                                                            <option value="5">Top 5</option>
                                                            <option value="10">Top 10</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                        <select id="chartField" name="chartField" class="form-control">
                                                            <option value="chartUser">customers who buy the most products</option>
                                                            <option value="chartCity">area bought the most of seafood</option>
                                                            <option value="chartProduct">best-selling seafood products</option>
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

                                <!-- <div class="col-lg-12 col-md-6" id="chartContainer" style="height: 370px; width: 100%;"></div>
                                <hr>
                                <div class="col-lg-12 col-md-6" id="chartPieContainer" style="height: 370px; width: 100%;"></div> -->
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card m-b-30">
                                            <div class="card-header">
                                                <div class="col-12 m-b-20">
                                                    <h3> Chart 1</h3>
                                                </div>
                                                <?php
                                                if (isset($_POST["chartLimit"])) {


                                                ?>
                                                    <h5>Top <?= $_POST["chartLimit"] ?> <?php
                                                                                        if (!empty($top10City)) {
                                                                                        ?>
                                                            <span>area bought the most of seafood</span>
                                                        <?php
                                                                                        } elseif (!empty($top10User)) {
                                                        ?>
                                                            <span>customers who buy the most products</span>
                                                        <?php
                                                                                        } elseif (!empty($top10Product)) {
                                                        ?>
                                                            <span>best-selling seafood products</span>
                                                        <?php
                                                                                        }
                                                        ?>
                                                    </h5>
                                                <?php
                                                } else {
                                                ?>
                                                    <h5>Top 3
                                                        <span>area bought the most of seafood</span>
                                                    </h5>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="card-body">
                                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card m-b-30">
                                            <div class="card-header">
                                                <h3>Chart 2</h3>
                                                <h5>The rate of the shop order</h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="chartPieContainer" style="height: 370px; width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {
            let activeId = null;
            document.getElementById('chartLimit').value = "<?php echo $_POST['chartLimit']; ?>";
            document.getElementById('chartField').value = "<?php echo $_POST['chartField']; ?>";
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
                    title: "Total Order"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## ",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]

            });
            chart.render();


            var chart = new CanvasJS.Chart("chartPieContainer", {
                animationEnabled: true,
                title: {
                    text: "Order rate"
                },
                subtitles: [{
                    text: "2021"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    indexLabelFontColor: "#36454F",
                    indexLabelFontSize: 9,
                    indexLabelFontWeight: "bolder",
                    showInLegend: true,
                    legendText: "{label}",
                    dataPoints: <?php echo json_encode($dataPiePoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>


</body>

</html>