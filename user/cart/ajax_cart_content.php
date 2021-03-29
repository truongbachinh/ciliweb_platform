<div class="container-fluid">
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }

    include "../connect_db.php";
    if (!empty($_SESSION["current_user"]['username'])) {

        $cartUserId = $_SESSION["current_user"]['user_id'];
    }
    if (!empty($_SESSION["current_user_social"]['fullname'])) {

        $cartUserId = $_SESSION["current_user_social"]['user_id'];
    }
    if (!empty($cartUserId)) {

        $cart_sql = "SELECT c.cart_id, c.cart_amount, c.cart_user_id, c.cart_product_id, p.p_name, p.p_price, p.p_image from cart as c inner join products as p on. c.cart_product_id = p.p_id where cart_user_id = '$cartUserId'";
        $result = mysqli_query($link, $cart_sql);
    }
    ?>
    <div>
        <form action="../payment/checkout.php" method="post" id="updateCartProduct" enctype="multipart/form-data">

            <table class="table table-bordered" style="text-align: center;">
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
                                <!-- <td><input type="checkbox" name="selectProduct" id="selectProduct"></td> -->
                                <td><?= $i++ ?></td>
                                <td><?= $row['p_name'] ?></td>
                                <td><img src="/ciliweb_project/shop/<?= $row['p_image'] ?>" width="60" height="70"></td>
                                <!-- <td> <input type="number" value="<?= $row["cart_amount"] ?>" name="quantity[<?= $row['cart_id'] ?>]" min="1" max="1000"></td> -->
                                <td> <input type="number" oninput="javascript:updateQuantity(this.value)" value="<?= $row["cart_amount"] ?>" name="quantity[<?= $row['cart_id'] ?>]" min="1" max="1000"></td>
                                <td><?= number_format($cost = $row["cart_amount"] *  $row["p_price"], 0, ",", ".")   ?>VNĐ</td>
                                <!-- <td><a href="cart.php?view=delete&cid=<?= $row['cart_id'] ?>"><i class="fas fa-trash-alt"></i></a></td> -->
                                <td><a href="javascript:deleteCartItem(<?= $row['cart_id'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
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