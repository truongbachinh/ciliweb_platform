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
where orders.order_shop_id = 8 GROUP BY orders.order_user_id ORDER BY COUNT(orders.id)");
$sumOrder = $link->query($queryTotalOrder);
$sumOrderArray = array();
while ($rowOrder = mysqli_fetch_array($sumOrder)) {
    $sumOrderArray[] =  $rowOrder;
}

$totalOrder = 0;
$otalUser = 0;
foreach ($sumOrderArray as $sumOrderValue) {
    $sum = $sumOrderValue['order_amount'];
    $sumUser[] = ($sumOrderValue['order_amount']);

    $totalOrder += $sum;
}
$totalUser = (COUNT($sumUser));

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

$chartSearch = null;
if (isset($_POST["submitFieldChart"])) {
    $chartSearch = $_POST["chartField"];
}

$queryChart = null;

$top10Array = array();
$dataPoints = array();
if ($chartSearch != null) {
    if ($chartSearch  == "orders.order_user_id") {
        $queryChart = ("SELECT COUNT(orders.id) as order_amount, orders.*, order_address.*,user.* from orders INNER JOIN user ON user.user_id = orders.order_user_id inner join order_address on order_address.oda_order_id = orders.id where orders.order_shop_id = $shopId GROUP BY orders.order_user_id ORDER BY COUNT(orders.id) DESC LIMIT 10");
        $top10User = $link->query($queryChart);
        while ($rowTop = mysqli_fetch_array($top10User)) {
            $top10Array[] =  $rowTop;
        }

        foreach ($top10Array as $value) {
            list($dataPoints[])  = array(
                array("y" =>  $value['order_amount'], "label" => $value['username']),
            );
        }
    } elseif ($chartSearch  == "order_address.oda_city") {
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
    } elseif ($chartSearch == "order.product") {
        $queryChart = ("SELECT order_items.*, COUNT(order_items.order_product_id) as order_product_count, orders.*, products.p_name FROM `order_items` INNER JOIN products ON products.p_id = order_items.order_product_id INNER JOIN orders ON orders.id = order_items.order_id WHERE orders.order_shop_id = $shopId GROUP BY order_items.order_product_id ORDER BY COUNT(order_items.order_product_id) DESC LIMIT 10");
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
} else {
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
            <iframe src="<?php echo get_trusted_url($user, $server, $view_url, $site); ?>"></iframe>
            <div class="container m-t-30">
                <div class="row d-fex justify-content-lg-between">
                    <div class="col-lg-2 col-md-6">
                        <div class="card m-b-30 ">
                            <div class="card-body">
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
                                                    <div class="col-md-6 mb-3">
                                                        <select id="chartField" name="chartField" class="form-control">
                                                            <option value="" selected>-----Top 10 of-----</option>
                                                            <option value="order_address.oda_city">Top 10 of City</option>
                                                            <option value="orders.order_user_id">Top 10 of User buy</option>
                                                            <option value="order.product">Top 10 best selling products</option>

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
                                                if (!empty($top10City)) {
                                                ?>
                                        <span>cities with the most orders</span>
                                    <?php
                                                } elseif (!empty($top10User)) {
                                    ?>
                                        <span>users who order the most </span>
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

            // $(document).on('click', 'btn-update-order', function(e) {
            //     Utils.api("update_order_shipping_infor", {
            //         id: activeId,
            //         updateOrderShipping: $("#updateShippingStatus").val(),
            //     }).then(response => {
            //         $("#editOrder").hide(),
            //             swal("Notice", response.msg, "success").then(function(e) {
            //                 location.replace("./manage_order.php");
            //             });
            //     }).catch(err => {

            //     })
            // });


            // $(document).on('click', '.btn-edit-order', function(e) {
            //     e.preventDefault();

            //     const orderId = parseInt($(this).data("id"));
            //     activeId = orderId;
            //     console.log(orderId);
            //     Utils.api("get_order_info_detail", {
            //         id: orderId
            //     }).then(response => {
            //         $.get("../api.php", function(orderDetailContentHtml) {
            //             console.log("order-count", orderDetailContentHtml);
            //             // $('#editOrder').modal();

            //         }).catch(err => {

            //         });
            //     });
            // });
            // $(document).on('click', '.btn-detail-order', function(e) {
            //     e.preventDefault();
            //     const orderId = parseInt($(this).data("id"));
            //     activeId = orderId;
            //     console.log(orderId);
            //     $.fancybox({
            //         'width': '60%',
            //         'height': '80%',
            //         'autoScale': true,
            //         'transitionIn': 'fade',
            //         'transitionOut': 'fade',
            //         'href': './bill.php',
            //         'type': 'iframe',
            //         'onClosed': function() {
            //             window.location.href = "./manage_order.php";
            //         }


            //     });
            //     return false;
            // });
            // $(document).on('click', '.btn-edit-order', function(e) {
            //     e.preventDefault();
            //     const orderId = parseInt($(this).data("id"));
            //     activeId = orderId;
            //     console.log(orderId);
            //     $.ajax({
            //         type: "POST",
            //         url: Utils.api("get_order_info_detail"),
            //         data: {
            //             "id": orderId
            //         },
            //         success: function(res) {
            //             if (res) {
            //                 var response = JSON.parse(res);
            //                 if (response.status == 0) {

            //                 } else {
            //                     $.get('../shop/bill.php', function(cartContentHTML) {
            //                         console.log("cart-count", cartContentHTML);
            //                         $('#viewDetailOrder').html(cartContentHTML);
            //                         $('#editOrder').modal();
            //                     })
            //                 }
            //             }
            //         }
            //     });
            // });


        });

        // $(document).ready(function() {
        //     $('#inputSearchOrder').keyup(function() {
        //         var txt = $(this).val();
        //         if (txt != '') {

        //         } else {
        //             $('#result').html('');
        //             $.ajax({
        //                 url: "search_order.php",
        //                 method: "post",
        //                 data: {
        //                     search: txt
        //                 },
        //                 dataType: "text",
        //                 success: function(data) {
        //                     $('#result').html(data)
        //                 }
        //             })
        //         }
        //     })
        // })
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
        }
    </script>


</body>

</html>