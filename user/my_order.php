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
                            foreach ($rowShopInfor as $rowS) {
                                $rowShopId = $rowS['shop_id'];

                                $orderProduct = $link->query("SELECT orders.*,order_items.*, products.* FROM order_items INNER JOIN products ON products.p_id = order_items.order_product_id INNER JOIN orders ON orders.id = order_items.order_id where orders.order_shop_id = '$rowShopId' AND orders.order_user_id = '$userId' ");
                                $myOrderProduct = array();
                                while ($rowOrderProduct = mysqli_fetch_array($orderProduct)) {
                                    $myOrderProduct[] =  $rowOrderProduct;
                                }
                            ?>
                                <div id="breadcrumb"><i class="fa fas-home" style="margin-left: 9px;"> Order of shop <i class="mdi mdi-arrow-right mdi-14px "></i><?php echo "<font>" . $rowS['shop_name'] . "</font>" ?></a></i></div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th> Id</th>
                                            <th>Order Id</th>
                                            <th>Order Product</th>
                                            <th>Order quantity</th>
                                            <th>Order cost</th>
                                            <th>Order satus</th>
                                            <th>Order create time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($myOrderProduct  as $rowMyOrderProduct) {

                                        ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $rowMyOrderProduct['id'] ?></td>
                                                <td><?= $rowMyOrderProduct['p_name'] ?></td>
                                                <td><?= $rowMyOrderProduct['quantity'] ?></td>
                                                <td><?= $rowMyOrderProduct['price'] ?></td>
                                                <?php if ($rowMyOrderProduct['payment_order_status'] == 1) {
                                                ?>
                                                    <td>Shipping</td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <?= date("Y-m-d H:i:s", $rowMyOrderProduct["order_create_time"]) ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>


                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>