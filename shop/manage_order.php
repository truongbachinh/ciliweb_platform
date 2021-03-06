<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
if (!isset($_SESSION['current_user'])) {
    header("location: ../account/login.php");
}


$res = $link->query("SELECT orders.*,user.*,order_address.* from orders INNER JOIN order_address ON orders.id = order_address.oda_order_id INNER JOIN user ON user.user_id = orders.order_user_id where order_shop_id  = $shopId  ");


$resTime = $link->query("SELECT orders.* from orders where order_shop_id  = $shopId  ");
$checkTime = array();
while ($rowTime =  mysqli_fetch_array($resTime)) {
    $checkTime[] = $rowTime;
}

foreach ($checkTime as $rowTimeOrder) {
    if (strtotime($rowTimeOrder['shipping_create_time']) != '-62169987208') {
        $checkTimeOrder = $rowTimeOrder['shipping_create_time'];

        $orderCheckTimeId = $rowTimeOrder['id'];
        $duration = 2;
        $duration_type = 'day';
        $deadline = date('Y-M-d H:i:s', strtotime($checkTimeOrder . ' +' . $duration . ' ' . $duration_type));

        $diff = abs(strtotime($timeInVietNam) - strtotime($checkTimeOrder));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));

        if ($years != 0) {
            $checkTimeCancle = $years . " years, " . $months . " months, " . $days . " days, " . $hours . " hours, " . $minutes . " minutes, " . $seconds . " seconds";
        } else if ($months != 0) {
            $checkTimeCancle = $months . " months, " . $days . " days, " . $hours . " hours, " . $minutes . " minutes, " . $seconds . " seconds";
        } else {
            $checkTimeCancle =  $days . " days, " . $hours . " hours, " . $minutes . " minutes, " . $seconds . " seconds";
        }
        if ($diff == 0) {
            $updateOrderShipping = $link->query("UPDATE `orders` SET `shipping_order_status`= '4', `shipping_cancle_time` = '$timeInVietNam' WHERE `id` = $orderCheckTimeId ");
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

        <section class="manage-page">
            <div class="container m-t-30">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 style="text-align:center"> Manage order </h2>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group has-search">
                                            <form action="" method="POST">
                                                <fieldset>
                                                    <legend>Search Order:</legend>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <span class="fa fa-search form-control-feedback"></span>
                                                            <input type="text" name="id" id="inputSearchOrderId" class="form-control" placeholder="Search">
                                                        </div>
                                                        <!-- <div class="col-md-4 mb-3">
                                                            <select id="shipping_order_status" name="shipping_order_status" class="form-control">
                                                                <option value="" selected>Shipping Status</option>
                                                                <option value="1">Not yet</option>
                                                                <option value="2">Shipped</option>
                                                                <option value="3">Order Received</option>
                                                                <option value="4">Order canceled</option>
                                                            </select>
                                                        </div> -->
                                                        <div class="search">

                                                            <input type="submit" name="submitSearch" id="submitSearch" value="Search" class="btn btn-info">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- <?php
                                        include("../pagination/pagination.php");
                                        ?> -->
                                <div class="table-responsive p-t-10">
                                    <table id="table_order" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Order Id</th>
                                                <th>User account</th>
                                                <th>Fullname</th>
                                                <th>Phone</th>
                                                <!-- <th>Address</th> -->
                                                <th>Total Cost</th>
                                                <!--  <th>Quantity</th> -->
                                                <th>Payment status</th>
                                                <th>Shipping status</th>
                                                <th>Shipping start time</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="result">
                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($res)) {
                                                // var_dump($row);
                                                // exit;
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $row['username'] ?></td>
                                                    <td><?= $row['oda_firstname'], " ", $row['oda_lastname'] ?></td>
                                                    <td><?= $row['oda_phone'] ?></td>
                                                    <!-- <td><?= $row['oda_address'] ?></td> -->
                                                    <td><?= number_format($row['order_total_cost'], 0, ",", ".") ?> VN??</td>
                                                    <!--  <td><?= $row['order_total_amount'] ?></td> -->

                                                    <?php
                                                    if (!empty($row['payment_order_status'] == 1)) {
                                                    ?>
                                                        <td>Payment on delivery </td>

                                                    <?php
                                                    } elseif (!empty($row['payment_order_status'] == 2)) {  ?>
                                                        <td>Payment online</td>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if (!empty($row['shipping_order_status'] == 1)) {
                                                    ?>
                                                        <td>Not yet</td>
                                                    <?php
                                                    } elseif (!empty($row['shipping_order_status'] == 2)) {  ?>
                                                        <td style="color:green">Shipped</td>
                                                    <?php
                                                    } elseif (!empty($row['shipping_order_status'] == 3)) {  ?>
                                                        <td style="color:red">Order Received</td>
                                                    <?php
                                                    } elseif (!empty($row['shipping_order_status'] == 4)) {  ?>
                                                        <td>Order canceled</td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (!empty($row['shipping_order_status'] == 1)) {
                                                    ?>
                                                        <td>Not Start</td>
                                                    <?php
                                                    } elseif (!empty($row['shipping_order_status'] == 2)) {  ?>
                                                        <td style="color:green"><?= date('d-M-Y  H:i:s', strtotime($row['shipping_create_time'])); ?></td>
                                                    <?php
                                                    } elseif (!empty($row['shipping_order_status'] == 3)) {  ?>
                                                        <td style="color:red"><?= date('d-M-Y  H:i:s', strtotime($row['shipping_receive_time'])); ?></td>
                                                    <?php
                                                    } elseif (!empty($row['shipping_order_status'] == 4)) {  ?>
                                                        <td style="color:red"><?= date('d-M-Y  H:i:s', strtotime($row['shipping_cancle_time'])) ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" class="btn btn-info  btn-edit-order" role="button" data-id="<?= $row["id"] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="" class="btn btn-danger btn-delete-order" role="button" data-id="<?= $row["id"] ?>"><i class="mdi mdi-delete"></i>
                                                            </a>
                                                            <a href="./bill.php?id=<?= $row['id'] ?>&idu=<?= $row['user_id'] ?>" class="btn btn-primary" role="button" data-id="<?= $row["id"] ?>"><i class="mdi mdi-dots-horizontal"></i> </a>
                                                            <!-- <a data-fancybox data-type="ajax" data-src="./bill.php?id=<?= $row['id'] ?>&idu=<?= $row['user_id'] ?>" href="javascript:;">Ajax content</a> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php

                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <?php
                                        include("../pagination/pagination.php");
                                        ?> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Detail -->
                <div class="modal fade" id="roleDetailModal" tabindex="-1" role="dialog" aria-labelledby="detailRole" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailRole">Detail order
                                    Information
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="detail">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Order Id</td>
                                                <td id="roleNameDetail"></td>
                                            </tr>
                                            <tr>
                                                <td>Ng?????i nh???n</td>
                                                <td id="roleDescriptionDetail"></td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td id="roleStatusDetail"></td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td id="roleCreateTime"></td>
                                            </tr>
                                            <tr>
                                                <td>S???n ph???m</td>
                                                <td id="roleUpdateTime"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="button-close float-right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editOrder" tabindex="-1" role="dialog" aria-labelledby="editOrder" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editOrder">Update Oder Information</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="edit-order-form">
                                    <div class="form-group">
                                        <label for=""> Order id:</label>
                                        <label for="updateOrderId" id="updateOrderId"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Account ordered:</label>
                                        <label for="updateOrderAccount" id="updateOrderAccount"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateShippingStatus">Shipping Status</label>
                                        <select id="updateShippingStatus" class="form-control">
                                            <option value="1">Not yet</option>
                                            <option value="2">Shipped</option>
                                            <option value="3">Order Received</option>
                                            <option value="4">Order canceled</option>
                                        </select>
                                    </div>
                                    <div class="model-footer">
                                        <button type="button" class="btn btn-warning btn-update-order">
                                            Save Changes
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </form>
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
            $('#table_order').DataTable();
        });
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
                            location.reload()
                        });
                }).catch(err => {

                })
            });
        });
    </script>
</body>

</html>