<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
if (!isset($_SESSION['current_user'])) {
    header("location: ../account/login.php");
}



$queryOnline = $link->query("SELECT COUNT( orders.payment_order_status) as online_payment , SUM(payments.money) as sum_online_payment FROM orders INNER JOIN payments ON payments.payment_order_id = orders.id WHERE orders.payment_order_status = 2 AND orders.shipping_order_status = 3 AND orders.order_shop_id = $shopId");
$totalOnline = mysqli_fetch_assoc($queryOnline);
$totalOnlinePayment = $totalOnline['online_payment'];
$totalSumOnlinePayment = $totalOnline['sum_online_payment'];

$queryOffline = $link->query("SELECT COUNT( orders.payment_order_status) as offline_payment,  SUM(orders.order_total_cost) as sum_offline_payment FROM orders WHERE orders.payment_order_status = 1 AND orders.shipping_order_status = 3 AND orders.order_shop_id = $shopId");
$totalOffline = mysqli_fetch_assoc($queryOffline);
$totalOfflinePayment = $totalOffline['offline_payment'];
$totalSumOfflinePayment = $totalOffline['sum_offline_payment'];

$sumPayment = 0;
$sumPayment = $totalSumOfflinePayment + $totalSumOnlinePayment;

if ($sumPayment != 0) {
    $dataPiePoints = array(

        array("label" => "Delivery", "y" => ($totalSumOfflinePayment / $sumPayment * 100)),
        array("label" => "Online", "y" => ($totalSumOnlinePayment / $sumPayment * 100)),
    );
}



$paymentOffLine = array();
$dataPoints1 = array();
$paymentOnline = array();
$dataPoints2 = array();
if (isset($_POST['submitDateChart'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $offlineQuery = $link->query("SELECT orders.order_shop_id, SUM(orders.order_total_cost) as MoneyOfDay , day(orders.shipping_receive_time) as DayOfMonth FROM orders WHERE orders.order_shop_id = $shopId AND orders.shipping_order_status = 3 AND orders.payment_order_status = 1  AND orders.shipping_receive_time BETWEEN '$startDate' AND '$endDate'  GROUP BY day(orders.shipping_receive_time)");

    while ($rowOffline = mysqli_fetch_array($offlineQuery)) {
        $paymentOffLine[] =  $rowOffline;
    }
    foreach ($paymentOffLine as $value) {
        list($dataPoints1[])  = array(

            array("label" => $value['DayOfMonth'], "y" => $value['MoneyOfDay']),
        );
    }


    $onlineQuery = $link->query("SELECT orders.order_shop_id, (payments.money) as MoneyOfDay , day(orders.shipping_receive_time) as DayOfMonth FROM orders INNER JOIN payments ON payments.payment_order_id = orders.id WHERE orders.order_shop_id = $shopId AND orders.shipping_order_status = 3 AND orders.payment_order_status = 2 AND orders.shipping_receive_time BETWEEN '$startDate' AND '$endDate' GROUP BY day(orders.shipping_receive_time)");

    while ($rowOnline = mysqli_fetch_array($onlineQuery)) {
        $paymentOnline[] =  $rowOnline;
    }
    foreach ($paymentOnline as $value) {
        list($dataPoints2[])  = array(
            array("label" => $value['DayOfMonth'], "y" => $value['MoneyOfDay']),
        );
    }
} else {
    $offlineQuery = $link->query("SELECT orders.order_shop_id, SUM(orders.order_total_cost) as MoneyOfDay , day(orders.shipping_receive_time) as DayOfMonth FROM orders WHERE orders.order_shop_id = $shopId AND orders.shipping_order_status = 3 AND orders.payment_order_status = 1 GROUP BY day(orders.shipping_receive_time)");
    while ($rowOffline = mysqli_fetch_array($offlineQuery)) {
        $paymentOffLine[] =  $rowOffline;
    }
    foreach ($paymentOffLine as $value) {
        list($dataPoints1[])  = array(

            array("label" => $value['DayOfMonth'], "y" => $value['MoneyOfDay']),
        );
    }


    $onlineQuery = $link->query("SELECT orders.order_shop_id, SUM(payments.money) as MoneyOfDay , day(orders.shipping_receive_time) as DayOfMonth FROM orders INNER JOIN payments ON payments.payment_order_id = orders.id WHERE orders.order_shop_id =  $shopId AND orders.shipping_order_status = 3 AND orders.payment_order_status = 2 GROUP BY day(orders.shipping_receive_time)");
    while ($rowOnline = mysqli_fetch_array($onlineQuery)) {
        $paymentOnline[] =  $rowOnline;
    }
    foreach ($paymentOnline as $value) {
        list($dataPoints2[])  = array(
            array("label" => $value['DayOfMonth'], "y" => $value['MoneyOfDay']),
        );
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

        <section class="manage-page">
            <div class="container m-t-30">
                <div class="row d-fex justify-content-lg-around">
                    <div class="col-lg-6 col-md-6">
                        <div class="card m-b-30 ">
                            <div class="card-body">
                                <div>
                                    <p class="text-muted text-overline m-0 text-center">Total of order with online payemnt</p>
                                    <h3 class="fw-400 text-center m-t-10">
                                        <?= $totalOnlinePayment ?>
                                    </h3>
                                </div>
                                <div>
                                    <p class="text-muted text-overline m-0 text-center">Total of money</p>
                                    <h3 class="fw-400 text-center m-t-10">
                                        <?= number_format($totalSumOnlinePayment, 0, ".", ",")  ?> VNĐ
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <div>
                                    <p class=" text-center text-muted text-overline m-0">Total of orders wiht delivery payment</p>
                                    <h3 class="fw-400 text-center m-t-10"> <?= $totalOfflinePayment ?></h3>
                                </div>
                                <div>
                                    <p class="text-muted text-overline m-0 text-center">Total of money</p>
                                    <h3 class="fw-400 text-center m-t-10">
                                        <?= number_format($totalSumOfflinePayment, 0, ".", ",")  ?> VNĐ
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-8">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <form action="" id="formStartToEnd" method="POST">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <input type="date" class="btn" name="startDate" id="startDate">
                                            </div>
                                            <span class="m-t-10 m-l-30">to</span>
                                            <div class="col-md-3 mb-3">
                                                <input type="date" class="btn" name="endDate" id="endDate">
                                            </div>
                                            <div class="search m-l-30">
                                                <input type="submit" name="submitDateChart" id="submitDateChart" value="Search" class="btn btn-info">
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="col-12 m-b-20">
                                    <h3>Chart 1</h3>
                                </div>
                                <div class="card-body">
                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h3>Chart 2</h3>
                                <h5>The rate of payment</h5>
                            </div>
                            <div class="card-body">
                                <div id="chartPieContainer" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>

                </div>
        </section>
        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        $(document).ready(function() {
            var timeLimit = $('#endDate').val;
            console.log("Time limit", timeLimit);
            jQuery.validator.addMethod("greaterThan",
                function(value, element, params) {
                    if (!/Invalid|NaN/.test(new Date(value))) {
                        return new Date(value) > new Date($(params).val());
                    }
                    return isNaN(value) && isNaN($(params).val()) ||
                        (Number(value) > Number($(params).val()));
                }, 'Must be greater than {0}.');

            jQuery.validator.addMethod("lesterThan",
                function(value, element, params) {
                    if (!/Invalid|NaN/.test(new Date(value))) {
                        return new Date(value) < new Date($(params).val());
                    }
                    return isNaN(value) && isNaN($(params).val()) ||
                        (Number(value) < Number($(params).val()));
                }, 'Must be lesterThan than {7}.');


            $('#formStartToEnd').validate({
                rules: {
                    endDate: {
                        greaterThan: "#startDate",

                    }

                },

                messages: {
                    endDate: "The end date should be greater than the start date",
                },
            })
        })


        document.getElementById('startDate').value = "<?php echo $_POST['startDate']; ?>";
        document.getElementById('endDate').value = "<?php echo $_POST['endDate']; ?>";
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
                    name: "Delivery",
                    indexLabel: "{y}",
                    yValueFormatString: "#,###.## VNĐ",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                }, {
                    type: "column",
                    name: "Online",
                    indexLabel: "{y}",
                    yValueFormatString: "#,###.## VNĐ",
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

            var chart = new CanvasJS.Chart("chartPieContainer", {
                animationEnabled: true,
                title: {
                    text: "Payment rate"
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