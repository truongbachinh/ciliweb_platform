<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];





$offlineQuery = $link->query("SELECT orders.order_shop_id, SUM(payments.money) as MoneyOfDay ,shop.shop_name, day(payments.time) as DayOfMonth FROM orders INNER JOIN payments ON payments.payment_order_id = orders.id INNER JOIN shop ON shop.shop_id = orders.order_shop_id WHERE orders.order_shop_id = '$shopId'AND orders.shipping_order_status = 3 AND orders.payment_order_status = 1 GROUP BY day(payments.time)");
$onlineQuery = $link->query("SELECT orders.order_shop_id, SUM(payments.money) as MoneyOfDay ,shop.shop_name, day(payments.time) as DayOfMonth FROM orders INNER JOIN payments ON payments.payment_order_id = orders.id INNER JOIN shop ON shop.shop_id = orders.order_shop_id WHERE orders.order_shop_id = '$shopId'AND orders.shipping_order_status = 3 AND orders.payment_order_status = 2 GROUP BY day(payments.time)");
$paymentOnline = array();
$paymentOffLine = array();
while ($rowOffline = mysqli_fetch_array($offlineQuery)) {
    $paymentOffLine[] =  $rowOffline;
}
while ($rowOnline = mysqli_fetch_array($onlineQuery)) {
    $paymentOnline[] =  $rowOnline;
}

$dataPoints1 = array();
$dataPoints2 = array();
foreach ($paymentOffLine as $value) {
    list($dataPoints1[])  = array(

        array("label" => $value['DayOfMonth'], "y" => $value['MoneyOfDay']),
    );
}
foreach ($paymentOnline as $value) {
    list($dataPoints2[])  = array(
        array("label" => $value['DayOfMonth'], "y" => $value['MoneyOfDay']),
    );
}



$dataPoints1s = array(
    array("x" => 2,    "y" => 1.6735),
    array("x" => 3,    "y" => 1.619),
    array("x" => 4,    "y" => 1.5673),
    array("x" => 5,    "y" => 1.5182),
    array("x" => 6,    "y" => 1.4715),
    array("x" => 7,    "y" => 1.4271),
    array("x" => 8,    "y" => 1.3847),
    array("x" => 9,    "y" => 1.3444),
    array("x" => 10,    "y" => 1.3059),
    array("x" => 11,    "y" => 1.2692),
    array("x" => 12,    "y" => 1.234),
    array("x" => 13,    "y" => 1.2005),
    array("x" => 14,    "y" => 1.1683),
    array("x" => 15,    "y" => 1.1375),
    array("x" => 16,    "y" => 1.1081),
    array("x" => 17,    "y" => 1.0798),
    array("x" => 18,    "y" => 1.0526),
    array("x" => 19,    "y" => 1.0266),
    array("x" => 20,    "y" => 1.0016),
    array("x" => 21,    "y" => 0.9775),
    array("x" => 22,    "y" => 0.9544),
    array("x" => 23,    "y" => 0.9321),
    array("x" => 24,    "y" => 0.9107),
    array("x" => 25,    "y" => 0.89),
    array("x" => 26,    "y" => 0.8701),
    array("x" => 27,    "y" => 0.8509),
    array("x" => 28,    "y" => 0.8324),
    array("x" => 29,    "y" => 0.8145),
    array("x" => 30,    "y" => 0.7972),
    array("x" => 31,    "y" => 0.7805),
    array("x" => 32,    "y" => 0.7644),
    array("x" => 33,    "y" => 0.7488),
    array("x" => 34,    "y" => 0.7337),
    array("x" => 35,    "y" => 0.7191),
    array("x" => 36,    "y" => 0.705),
    array("x" => 37,    "y" => 0.6913),
    array("x" => 38,    "y" => 4.678),
    array("x" => 39,    "y" => 2.6652),
    array("x" => 40,    "y" => 3.6527),
    array("x" => 45,    "y" => 1.5958),
    array("x" => 50,    "y" => 2.5465),
    array("x" => 55,    "y" => 0.5036),
    array("x" => 60,    "y" => 1.466),
    array("x" => 65,    "y" => 1.4329),
    array("x" => 70,    "y" => 2.4035),
    array("x" => 75,    "y" => 8.3774),
    array("x" => 80,    "y" => 7.354)
);
$dataPoints2s = array(
    array("x" => 2,    "y" => 0.9999),
    array("x" => 3,    "y" => 1),
    array("x" => 4,    "y" => 1),
    array("x" => 5,    "y" => 1),
    array("x" => 6,    "y" => 1.9999),
    array("x" => 7,    "y" => 0.9999),
    array("x" => 8,    "y" => 2.9999),
    array("x" => 9,    "y" => 0.2),
    array("x" => 10,    "y" => 0.3997),
    array("x" => 11,    "y" => 0.5996),
    array("x" => 12,    "y" => 4.9995),
    array("x" => 13,    "y" => 2.9994),
    array("x" => 14,    "y" => 1.9992),
    array("x" => 15,    "y" => 0.9991),
    array("x" => 16,    "y" => 0.9989),
    array("x" => 17,    "y" => 0.9988),
    array("x" => 18,    "y" => 0.9986),
    array("x" => 19,    "y" => 0.9984),
    array("x" => 20,    "y" => 0.9982),
    array("x" => 21,    "y" => 0.998),
    array("x" => 22,    "y" => 0.9978),
    array("x" => 23,    "y" => 0.9975),
    array("x" => 24,    "y" => 0.9973),
    array("x" => 25,    "y" => 0.997),
    array("x" => 26,    "y" => 0.9968),
    array("x" => 27,    "y" => 0.9965),
    array("x" => 28,    "y" => 0.9962),
    array("x" => 29,    "y" => 0.9959),
    array("x" => 30,    "y" => 0.9956),
    array("x" => 31,    "y" => 0.9953),
    array("x" => 32,    "y" => 0.995),
    array("x" => 33,    "y" => 7.9947),
    array("x" => 34,    "y" => 6.9944),
    array("x" => 35,    "y" => 2.994),
    array("x" => 36,    "y" => 3.9937),
    array("x" => 37,    "y" => 1.9933),
    array("x" => 38,    "y" => 6.993),
    array("x" => 39,    "y" => 5.9926),
    array("x" => 40,    "y" => 1.9922),
    array("x" => 45,    "y" => 2.9902),
    array("x" => 50,    "y" => 4.988),
    array("x" => 55,    "y" => 3.9857),
    array("x" => 60,    "y" => 2.9832),
    array("x" => 65,    "y" => 2.9806),
    array("x" => 70,    "y" => 1.9778),
    array("x" => 75,    "y" => 2.9748),
    array("x" => 80,    "y" => 3.9718)
);


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
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 style="text-align:center"> Manage Revenue</h2>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div id="chartContainers" style="height: 370px; width: 100%;"></div>
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
            $(document).on('click', '.btn-edit-order', function(e) {
                e.preventDefault();
                const orderId = parseInt($(this).data("id"));
                activeId = orderId;
                console.log(orderId);
                Utils.api("get_order_shipping_info", {
                    id: orderId
                }).then(response => {
                    $("#updateOrderId").html(response.data.id)
                    $("#updateOrderAccount").html(response.data.username)
                    $("#updateShippingStatus").val(response.data.shipping_order_status)
                    $('#editOrder').modal();
                }).catch(err => {

                });
            });

            $(document).on('click', '.btn-update-order', function(e) {
                Utils.api("update_order_shipping_infor", {
                    id: activeId,
                    updateOrderShipping: $("#updateShippingStatus").val(),
                }).then(response => {
                    $("#editOrder").modal("hide"),
                        swal("Notice", response.msg, "success").then(function(e) {
                            location.replace("./manage_order.php");
                        });
                }).catch(err => {

                })
            });
        });

        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light3",
                title: {
                    text: "Payment amount in one day."
                },
                axisY: {
                    includeZero: true
                },
                legend: {
                    cursor: "pointer",
                    verticalAlign: "center",
                    horizontalAlign: "right",
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "column",
                    name: "Offline payment",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.## VNĐ",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                }, {
                    type: "column",
                    name: "Online payment",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.## VNĐ",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }




            var chart = new CanvasJS.Chart("chartContainers", {
                animationEnabled: true,
                title: {
                    text: "User payment trend when buying products at the shop"
                },
                axisX: {
                    title: "Days"
                },
                axisY: {
                    title: "Offlines payment [Off/P]",
                    titleFontColor: "#4F81BC",
                    lineColor: "#4F81BC",
                    labelFontColor: "#4F81BC",
                    tickColor: "#4F81BC"
                },
                axisY2: {
                    title: "Online payment [On/P]",
                    titleFontColor: "#C0504E",
                    lineColor: "#C0504E",
                    labelFontColor: "#C0504E",
                    tickColor: "#C0504E"
                },
                legend: {
                    cursor: "pointer",
                    dockInsidePlotArea: true,
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "line",
                    name: "Offlines payment",
                    markerSize: 0,
                    toolTipContent: "Day: {x} Days <br>{name}: {y} Off/P",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints1s, JSON_NUMERIC_CHECK); ?>
                }, {
                    type: "line",
                    axisYType: "secondary",
                    name: "Online payment",
                    markerSize: 0,
                    toolTipContent: "Day: {x} Days <br>{name}: {y} On/P",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints2s, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }

        }
    </script>
</body>

</html>