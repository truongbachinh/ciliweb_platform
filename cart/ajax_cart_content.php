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

        $result = $link->query("SELECT cart.*, products.*, shop.* from cart INNER JOIN products on cart.cart_product_id = products.p_id INNER JOIN shop ON shop.shop_id = products.p_shop_id where cart_user_id ='$cartUserId'");
    }
    ?>
    <div>
        <form action="../payment/checkout.php" method="post" id="updateCartProduct" enctype="multipart/form-data">
            <table class="table table-bordered table-striped" style="text-align: center; background-color:blanchedalmond !important">
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
                    if (!empty($result)) {
                        $total = 0;
                        $count = 0;
                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) {

                    ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row['p_name'] ?></td>
                                <td><img src="../shop/image_products/<?= $row['p_image'] ?>" width="60" height="70"></td>
                                <td> <input type="number" oninput="javascript:updateQuantity(this.value)" value="<?= $row["cart_quantity"] ?>" name="quantity[<?= $row['cart_id'] ?>]" min="1" max="1000"></td>
                                <td><?= number_format($cost = $row["cart_quantity"] *  $row["p_price"], 0, ",", ".")   ?>VNĐ</td>
                                <td><a href="javascript:deleteCartItem(<?= $row['cart_id'] ?>)"><i class="mdi mdi-delete-empty mdi:20px"></i></a></td>
                            </tr>

                        <?php
                            $total += $cost;
                        }
                        ?>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="totalCost">
                <div style="float:left">
                    <?php
                    if (!empty($total)) {
                    ?>
                        <span>Total cost</span>&emsp;&emsp;<span><?= number_format($total, 0, ",", ".") ?>VNĐ</span>

                    <?php
                    }
                    ?>
                </div>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <div style="float:right">
                    <input type="submit" class="btn btn-success" name="checkoutCart" value="Checkout"></input>
                </div>
            </div>

        </form>
    </div>
</div>