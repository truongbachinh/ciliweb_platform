<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
$idOrder = $_GET["id"];
$idUserOrder = $_GET["idu"];
$billDetail = "SELECT order_address.*, orders.*, order_items.*,user.*, products.p_name as order_product_name, products.p_image as order_product_image from orders INNER JOIN order_items ON orders.id = order_items.order_id INNER JOIN products ON products.p_id = order_items.order_product_id INNER JOIN user ON user.user_id = orders.order_user_id INNER JOIN order_address ON order_address.oda_order_id = orders.id WHERE orders.id = $idOrder AND order_user_id = $idUserOrder";

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

        <?php
        $res = mysqli_query($link, $billDetail);
        $bill = array();

        while ($row = mysqli_fetch_array($res)) {
            $bill[] = $row;
            $nameRecipient = $row['fullname'];
            $address = $row['oda_address'];
            $phone = $row['oda_phone'];
        }


        ?>

        <div id="order-detail-wrapper" style="margin-left: 300px;">
            <div id="order-detail">
                <h1>Bill Detail</h1>
                <label>User name: &nbsp;</label><span><?= $nameRecipient ?></span><br>
                <label>Address: &nbsp;</label><span><?= $address ?></span><br>
                <label>Phone: &nbsp; </label><span><?= $phone ?></span><br>
                <br>
                <hr>
                <h3>Product List</h3>
                <ul>
                    <?php
                    $totalQuantity = 0;
                    $totalMoney = 0;
                    foreach ($bill as $order) {


                    ?>
                        <li>
                            <span><?= $order['order_product_name'] ?></span><br>
                            <span>
                                <?php
                                if ($res->num_rows > 0) {

                                    $imageURL = '../shop/image_products/' . $order["order_product_image"];
                                ?>
                                    <div>
                                        <a href="<?= $row['img_id'] ?>"> <img src="<?php echo $imageURL; ?>" alt="" width="70" height="70" class="img-fluid" id="img-view-details" />
                                        </a>

                                    </div>

                                <?php
                                } else { ?>
                                    <p>No image(s) found...</p>
                                <?php } ?>
                            </span>
                            <span>SL: <?= $order['quantity'] ?></span><br>
                            <span>cost: <?= $t = number_format($order['quantity'] * $order['price'], 0, ",", ".") ?>VNĐ </span><br>
                            <span>Payment: Not yet </span><br>
                            <br>

                        </li>
                    <?php
                        $totalMoney = $order['order_total_cost'];
                        $totalQuantity = $order['order_total_amount'];
                    }
                    ?>
                    <form action="">
                        <div class="form-group col-lg-4">
                            <label for="inp-role">Ship status</label>
                            <select id="inp-role" class="form-control">
                                <option value="1" selected>No shipping</option>
                                <option value="2">Cancle</option>
                                <option value="3">Shipping</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning">Update order</button>
                    </form>
                    <?php
                    ?>
                </ul>
                <hr>
                <label>Total quantity:&nbsp; </label><span><?= $totalQuantity ?></span> - <label>Total Cost:&nbsp; </label><span><?= number_format($totalMoney, 0, ",", ".") ?>VNĐ</span>
            </div>
        </div>


        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {
            let activeId = null;
            $(document).on('click', ".btn-add-role", function(e) {
                Utils.api("add_role_info", {
                    roleName: $('#addNameRole').val(),
                    roleDescription: $('#addDescriptionRole').val(),
                }).then(response => {



                }).catch(err => {

                })
            });
            $(document).on('click', ".btn-get-role-info", function(e) {
                e.preventDefault();
                $('#roleDetailModal').modal();
                const roleId = parseInt($(this).data("id"));
                activeId = roleId;
                console.log(roleId);
                Utils.api("get_role_info", {
                    id: roleId
                }).then(response => {
                    console.log("name", response.data.role_name);
                    $('#roleNameDetail').text(response.data.role_name);
                    $('#roleDescription').text(response.data.role_description);
                    $('#roelStatus').texy(response.data.role_status);
                    $('#roelCreateTime').text(response.data.role_create_time);
                    $('#roelUpdateTime').text(response.data.topic_update_time);
                    $('#roleDetailModal').modal();
                }).catch(err => {

                })
            });
        })
    </script>
</body>

</html>