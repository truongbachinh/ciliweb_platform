<?php
include "../config_shop.php";
if (!isset($_SESSION['current_user'])) {
    header("location: ../account/login.php");
}
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
$idOrder = $_GET["id"];
$idUserOrder = $_GET["idu"];
$billDetail = "SELECT order_address.*, orders.*, order_items.*,user.*, products.p_name as order_product_name, products.p_image as order_product_image from orders INNER JOIN order_items ON orders.id = order_items.order_id INNER JOIN products ON products.p_id = order_items.order_product_id INNER JOIN user ON user.user_id = orders.order_user_id INNER JOIN order_address ON order_address.oda_order_id = orders.id WHERE orders.id  = $idOrder AND order_user_id = $idUserOrder";


$res = mysqli_query($link, $billDetail);
$bill = array();

while ($row = mysqli_fetch_array($res)) {
    $bill[] = $row;
    $firstName = $row['oda_firstname'];
    $lastName = $row['oda_lastname'];
    $address = $row['oda_address'];
    $city = $row['oda_city'];
    $district = $row['oda_district'];
    $phone = $row['oda_phone'];
    $orderTime = $row['order_create_time'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./css/bill.css">
    <?php include "../partials/html_header.php"; ?>
</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside_shop.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header_shop.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->

        <section class="manage-page">
            <div class="container m-t-30">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h1 class="bill-title"> <i> Bill Detail</i> </h1>
                                </div>
                                <div id="order-time">
                                    <p class="bill-title">Time order, <?= date('d-M-Y  H:i:s', strtotime($orderTime))  ?> </p>
                                </div>
                            </div>
                            <hr class="hr-line">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 m-l-20">
                                        <div class="card-title">
                                            <h3 class=" bill-information">Receiver's information:</h3>
                                        </div>
                                        <div class="card-text">
                                            <p class="infor"><b> Receiver name:</b> &nbsp;<span><?= $firstName, " ",  $lastName ?></span></p>
                                            <p class="infor"><b> Address:</b> &nbsp;<span><?= $address ?></span><br></p>
                                            <p class="infor"><b> Township / District:</b> &nbsp;<span><?= $district ?></span><br></p>
                                            <p class="infor"><b> Province / City:</b> &nbsp;<span><?= $city ?></span><br></p>
                                            <p class="infor"><b> Phone:</b> &nbsp; <span><?= $phone ?></span><br></p>
                                        </div>
                                    </div>
                                    <hr class="hr-line">
                                    <div class="col-lg-12 ">
                                        <div class="card-title m-l-20">
                                            <h3 class=" bill-information"> Product list:</h3>
                                        </div>
                                        <div class="table-responsive p-t-30">
                                            <table class="table">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No</th>
                                                        <th>Product name</th>
                                                        <th>Image</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total = 0;
                                                    $totalMoney = 0;
                                                    $count = 0;
                                                    $totalQuantity = 0;
                                                    $i = 1;
                                                    foreach ($bill as $order) {
                                                    ?>
                                                        <tr>
                                                            <td class="bill-product"><?= $i++ ?></td>
                                                            <td class="bill-product"><?= $order["order_product_name"] ?></td>
                                                            <?php
                                                            if ($res->num_rows > 0) {
                                                                $imageURL = "../shop/image_products/" . $order["order_product_image"];
                                                            ?>
                                                                <td class="bill-product">
                                                                    <img src="<?php echo $imageURL; ?>" alt="" width="70" height="70" class="img-fluid" id="img-view-details" />


                                                                </td>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <td class="bill-product">
                                                                    <p>No image(s) found...</p>
                                                                </td>
                                                            <?php
                                                            }
                                                            ?>
                                                            <td class="bill-product"><?= number_format($order["price"], 0, ",", ".") ?>VNĐ</td>
                                                            <td class="bill-product"><?= $order["quantity"] ?></td>
                                                            <td class="bill-product"><?= number_format($cost = $order["quantity"] * $order["price"], 0, ",", ".") ?>VNĐ</td>
                                                        </tr>
                                                    <?php

                                                        $count += $order["quantity"];
                                                        $total += $cost;
                                                    }
                                                    $totalQuantity += $count;
                                                    $totalMoney += $total;

                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="total-bill col-md-4 m-r-10 m-t-20 m-b-20">
                                                <ul class="list-group mb-3">
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Total Quantity</span>
                                                        <strong><?= $totalQuantity ?></strong>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Total Cost</span>
                                                        <strong><?= number_format($totalMoney, 0, ",", ".") ?>VNĐ</strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr class="hr-line">
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
            $(document).on('click', '.btn-edit-order', function(e) {
                e.preventDefault();

                const orderId = parseInt($(this).data("id"));
                activeId = orderId;
                console.log(orderId);
            })
        });
    </script>
</body>

</html>