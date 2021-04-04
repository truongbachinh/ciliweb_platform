<div class="container-fluid">
    <?php
    if (!isset($_SESSION)) {
        include "../config_user.php";
    }
    if (!empty($_SESSION["current_user"]['username'])) {

        $cartUserId = $_SESSION["current_user"]['user_id'];
    }
    if (!empty($_SESSION["current_user_social"]['fullname'])) {

        $cartUserId = $_SESSION["current_user_social"]['user_id'];
    }
    if (!empty($cartUserId)) {

        $result = $link->query("SELECT cart.*, products.*, shop.* from cart INNER JOIN products on cart.cart_product_id = products.p_id INNER JOIN shop ON shop.shop_id = products.p_shop_id where cart_user_id ='$cartUserId' GROUP BY shop.shop_id");
        $cartShopInfor = array();
        while ($rowShop = mysqli_fetch_array($result)) {
            $cartShopInfor[] =  $rowShop;
        }
    }
    ?>

    <div class="table-responsive p-t-10">
        <form action="../payment/checkout.php" method="post" id="updateCartProduct" enctype="multipart/form-data">
            <div class="table-responsive p-t-10">
                <?php
                if (!empty($result)) {
                    $totalCostAmoutShop = 0;
                    foreach ($cartShopInfor as $rowShop) {
                        $rowShopId = $rowShop['shop_id'];
                        $cartProduct = $link->query("SELECT cart.*, products.*, shop.* from cart INNER JOIN products on cart.cart_product_id = products.p_id INNER JOIN shop ON shop.shop_id = products.p_shop_id where cart_user_id ='$cartUserId' and shop_id = '$rowShopId'");
                        $myCartProduct = array();
                        while ($rowCartProduct = mysqli_fetch_array($cartProduct)) {
                            $myCartProduct[] =  $rowCartProduct;
                        }  ?>
                        <table class="table table-hover table-bordered table-striped" style="text-align: center; background-color:blanchedalmond !important">
                            <div id="cart-shop">
                                <div><img src="../shop/image_shop/<?= $rowShop['shop_avatar'] ?>" width="60" height="70"></div>
                                <div id="breadcrumb"><i class="fa fas-home" style="margin-left: 9px;"> Order of shop <i class="mdi mdi-arrow-right mdi-14px "></i><?php echo "<font>" . $rowShop['shop_name'] . "</font>" ?></a></i></div>
                            </div>
                            <thead>
                                <tr>
                                    <!-- <th>Select</th> -->
                                    <th>NO.</th>
                                    <th>Product name</th>
                                    <th>Image</th>
                                    <th>Amount</th>
                                    <th>Price (VND)</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $total = 0;
                                $totalCost = 0;
                                $count = 0;
                                $i = 1;
                                foreach ($myCartProduct  as $rowMyCartProduct) {
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $rowMyCartProduct['p_name'] ?></td>
                                        <td><img src="../shop/image_products/<?= $rowMyCartProduct['p_image'] ?>" width="60" height="70"></td>
                                        <td> <input type="number" oninput="javascript:updateQuantity(this.value)" value="<?= $rowMyCartProduct["cart_quantity"] ?>" name="quantity[<?= $rowMyCartProduct['cart_id'] ?>]" min="1" max="1000"></td>
                                        <td><?= number_format($cost = $rowMyCartProduct["cart_quantity"] *  $rowMyCartProduct["p_price"], 0, ",", ".")   ?>VNĐ</td>
                                        <td><a href="javascript:deleteCartItem(<?= $rowMyCartProduct['cart_id'] ?>)"><i class="mdi mdi-delete-empty mdi:20px"></i></a></td>
                                    </tr>


                                <?php
                                    // var_dump($cost);
                                    $total += $cost;
                                }
                                ?>
                                <tr>
                                    <td>Total Cost</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td><?= number_format($total, 0, ",", ".") ?></td>
                                    <td>Delete</td>
                                </tr>

                            <?php
                            $totalCost += $total;
                            $totalCostAmoutShop += $totalCost;
                        }

                            ?>

                        <?php



                    }




                        ?>
                            </tbody>
                        </table>

                        <div class="total-cost-all" style="float:right">
                            <?php
                            if (!empty($totalCostAmoutShop)) {
                            ?>
                                <span><b>Total cost</b></span>&emsp;&emsp;<span><?= number_format($totalCostAmoutShop, 0, ",", ".") ?>VNĐ</span>

                            <?php
                            }
                            ?>

                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                            <input type="submit" class="btn btn-success" name="checkoutCart" value="Checkout"></input>
                        </div>

            </div>
        </form>
    </div>
</div>