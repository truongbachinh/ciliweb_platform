<?php
include "../config_admin.php";
if (!isset($_SESSION['current_user'])) {
    header("location: ./account/login.php");
}

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