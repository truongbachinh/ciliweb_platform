<?php
$orderShop = $link->query("SELECT orders.*, shop.* FROM `orders` INNER JOIN shop ON shop.shop_id = orders.order_shop_id WHERE orders.order_user_id = '$userId' GROUP BY shop.shop_id");
$cartInforOrder = array();
while ($rowShop = mysqli_fetch_array($orderShop)) {
    $rowShopInfor[] =  $rowShop;
}

$orderProduct = $link->query(" ");
?>


<link rel="stylesheet" href="./css/my_order.css">
<section class="my-order" style="margin-top: 80px">
    <div class="container m-t-30">
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4> Manage order </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-t-10">
                            <?php
                            if (isset($rowShopInfor)) {


                                foreach ($rowShopInfor as $rowS) {
                                    $rowShopId = $rowS['shop_id'];

                                    $orderProduct = $link->query("SELECT orders.*,order_items.*, products.*, orders.id as order_id FROM order_items INNER JOIN products ON products.p_id = order_items.order_product_id INNER JOIN orders ON orders.id = order_items.order_id where orders.order_shop_id = '$rowShopId' AND orders.order_user_id = '$userId' GROUP BY orders.id ");
                                    $myOrderProduct = array();
                                    while ($rowOrderProduct = mysqli_fetch_array($orderProduct)) {
                                        $myOrderProduct[] =  $rowOrderProduct;
                                    }
                            ?>
                                    <div id="breadcrumb"><i class="fa fas-home" style="margin-left: 9px;"> Order of shop <i class="mdi mdi-arrow-right mdi-14px "></i><?php echo "<font>" . $rowS['shop_name'] . "</font>" ?></a></i>
                                    </div>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th> Id</th>
                                                <th>Order Id</th>
                                                <th>Order create time</th>
                                                <!-- <th>Order total Cost</th>
                                            <th>Order total quantity</th> -->
                                                <th>Order shipping satus</th>
                                                <th>Order shipping time</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $cost = 0;
                                            foreach ($myOrderProduct  as $rowMyOrderProduct) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $rowMyOrderProduct['order_id'] ?></td>
                                                    <td>
                                                        <?= "Start: ", date("Y-m-d H:i:s", $rowMyOrderProduct["order_create_time"]) ?>
                                                    </td>
                                                    <!-- <td><?= $rowMyOrderProduct['order_total_cost'] ?></td>
                                                <td><?= $rowMyOrderProduct['order_total_amount'] ?></td> -->
                                                    <?php if ($rowMyOrderProduct['shipping_order_status'] == 1) {
                                                    ?>
                                                        <td>Ordered</td>
                                                    <?php
                                                    } elseif ($rowMyOrderProduct['shipping_order_status'] == 2) {
                                                    ?>
                                                        <td>Shipping</td>
                                                    <?php
                                                    } elseif ($rowMyOrderProduct['shipping_order_status'] == 3) {
                                                    ?>
                                                        <td>Received</td>
                                                    <?php
                                                    } elseif ($rowMyOrderProduct['shipping_order_status'] == 4) {
                                                    ?>
                                                        <td>Cencle</td>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php if ($rowMyOrderProduct['shipping_order_status'] == 1) {
                                                    ?>
                                                        <td>Waiting</td>
                                                    <?php
                                                    } elseif ($rowMyOrderProduct['shipping_order_status'] == 2) {
                                                    ?>
                                                        <td> <?= date("Y-d-M H:i:s", $rowMyOrderProduct['shipping_create_time']) ?></td>
                                                    <?php
                                                    } elseif ($rowMyOrderProduct['shipping_order_status'] == 3) {
                                                    ?>
                                                        <td> <?= date("Y-d-M H:i:s", $rowMyOrderProduct['shipping_receive_time']) ?> </td>
                                                    <?php
                                                    } elseif ($rowMyOrderProduct['shipping_order_status'] == 4) {
                                                    ?>
                                                        <td>Cencle</td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <!-- <a href="" class="btn btn-info  btn-edit-order-user" role="button" data-id="<?= $rowMyOrderProduct["order_id"] ?>"><i class="mdi mdi-pencil-outline"></i> </a> -->
                                                            <button onclick="editOrderUser(<?= $rowMyOrderProduct['order_id'] ?>)" class="btn btn-info" role="button">
                                                                <i class="mdi mdi-pencil-outline"></i>
                                                            </button>
                                                            <a href="" class="btn btn-danger btn-delete-order-user" role="button" data-id="<?= $rowMyOrderProduct["order_id"] ?>"><i class="mdi mdi-delete"></i>
                                                            </a>
                                                            <a href="index.php?view=my_order-detail&id=<?= $rowMyOrderProduct['order_id'] ?>" class=" btn btn-primary" role="button"><i class="mdi mdi-dots-horizontal"></i> </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal edit -->
        <div class="modal fade" id="editOrderUser" tabindex="-1" role="dialog" aria-labelledby="editOrderUser" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrderUser">Update Oder Information</h5>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="edit-order-form">
                            <div class="form-group">
                                <input type="hidden" name="idOrderUser" id="idOrderUser">
                            </div>
                            <div class="form-group">
                                <label for=""> Order id:</label>
                                <label for="updateOrderId" id="updateOrderId"></label>
                            </div>
                            <div class="form-group">
                                <label for="">Account ordered:</label>
                                <label for="updateOrderAccount" id="updateOrderAccount"></label>
                            </div>
                            <div class="form-group">
                                <label for="">Time ordered:</label>
                                <label for="updateOrderTime" id="updateOrderTime"></label>
                            </div>
                            <div class="form-group">
                                <label for="updateShippingStatus">Shipping Status</label>
                                <select id="updateShippingStatus" class="form-control">
                                    <option value="1">Waiting </option>
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
    </div>
</section>