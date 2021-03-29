<?php
session_start();
include "../connect_db.php";

if (!empty($_SESSION["current_user"]['username'])) {

    $cartUserId = $_SESSION["current_user"]['user_id'];
}
if (!empty($_SESSION["current_user_social"]['fullname'])) {

    $cartUserId = $_SESSION["current_user_social"]['user_id'];
}


$resultCart = $link->query("SELECT shop.*, cart.*, products.* FROM cart INNER JOIN products ON products.p_id = cart.cart_product_id INNER JOIN shop ON shop.shop_id = products.p_shop_id WHERE cart.cart_user_id   = '$cartUserId'");
$resultCarts = $link->query("SELECT shop.*, cart.*, products.* FROM cart INNER JOIN products ON products.p_id = cart.cart_product_id INNER JOIN shop ON shop.shop_id = products.p_shop_id WHERE cart.cart_user_id   = '$cartUserId'");
$cartInforCheckout = array();
$a = array();
while ($rowC = mysqli_fetch_array($resultCart)) {
    $cartInforCheckout[] =  $rowC;
    $a[] = $rowC['shop_id'];
}


$rowProduct = array();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- font-cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <!-- bootstrap 4 cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jquery 4 cdn -->
    <link src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    <link rel="stylesheet" href="./css/checkout.css">
</head>

<body>
    <div>
        <?php
        include "header_payment.php";
        ?>
    </div>
    <div id="orderForm">
        <div class="container">

            <div class="py-5 text-center">

                <h2>Checkout form</h2>
                <p class="lead">Below is form checkout of seafoodweb please field information bellow to order.</p>
            </div>



            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill"><?= count($cartInforCheckout) ?></span>
                    </h4>
                    <ul class="list-group mb-3">
                        <?php
                        $total = 0;
                        $count = 0;

                        // $ctG = array();
                        $countShop = array();
                        foreach ($cartInforCheckout as  $row) {

                        ?>

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div class="d-flex flex-column">
                                    <h6 class="my-0">Product Infor</h6>
                                    <div id="avatar-products" class=" my-2">
                                        <img src="../../shop/image_products/<?php echo $row['p_image'] ?>" style=" border-radius:5px " width="60" height="60" id="img-infor" class="img-fluid  ">
                                    </div>
                                    <small class="text-muted">Name: <?= $row['p_name'] ?></small>
                                    <small class="text-muted">Quantity: <?= $quantity = $row['cart_quantity'] ?></small>
                                    <small class="text-muted">Shop: <?= $row['shop_name'] ?></small>
                                </div>
                                <span class="text-muted"><?= number_format($cost  = $row["cart_quantity"] *  $row["p_price"], 0, ",", ".") . ' VNĐ' ?></span>
                            </li>
                        <?php
                            $total += $cost;
                            $count += $quantity;
                        }



                        ?>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total cost</span>
                            <strong><?= number_format($total, 0, ",", ".") ?>VNĐ</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total Quantity</span>
                            <strong><?= $count ?></strong>
                        </li>
                    </ul>
                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Redeem</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form method="post" name="formCheckout" action="" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phoneNumber">Phone number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i style="color:#f9b34c;" class="fas fa-phone-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="phoneNumber" required>
                                <div class="invalid-feedback" style="width: 100%;">
                                    Phone number is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i style="color:#f9b34c;" class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="address" name="address1" placeholder="1234 Main St" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i style="color:#f9b34c;" class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country</label>
                                <select class="custom-select d-block w-100" id="country" name="selectCountry" required>
                                    <option value="">Choose...</option>
                                    <option>Vietnam</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State</label>
                                <select class="custom-select d-block w-100" id="state" name="selectStates" required>
                                    <option value="">Choose...</option>
                                    <option>Hanoi</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zipCode" placeholder="" required>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address2">Note <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i style="color:#f9b34c;" class="fas fa-clipboard"></i></span>
                                </div>
                                <textarea type="text" name="noteCheckout" class="form-control" id="address2" placeholder="Apartment or suite"></textarea>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="same-address">
                            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">Save this information for next time</label>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" name="buttonCheckout">Continue to checkout</button>
                    </form>
                </div>
            </div>

            <footer class="my-5 pt-5 text-muted text-center text-small">
                <p class="mb-1">&copy; 2020-2021 Chinh TB</p>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Privacy</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">Support</a></li>
                </ul>
            </footer>
        </div>
    </div>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- fancybox -->
    <!-- <script type="text/javascript" src="./library/fancybox/jquery.fancybox.min.js"></script> -->
</body>

</html>

<?php
if (isset($_POST["buttonCheckout"])) {
    // var_dump($_POST);
    // exit;
    // // xủ lý giỏ hàng lưu vào db

    $cartOrder = $link->query("SELECT shop.*, c.cart_id, SUM(c.cart_quantity) as total_amount, c.cart_user_id, c.cart_product_id, p.p_name, SUM(p.p_price) as total_price, p_fresh, p.p_image from cart as c inner join products as p on. c.cart_product_id = p.p_id inner join shop on p.p_shop_id = shop.shop_id where cart_user_id = '$cartUserId' GROUP BY shop.shop_id");
    $cartInforOrder = array();
    while ($rowCart = mysqli_fetch_array($cartOrder)) {
        $cartInforOrder[] =  $rowCart;
    }
    $insertOrderString = "";
    foreach ($cartInforOrder  as $keys => $carts) {

        $order = $link->query("INSERT INTO `orders` (`id`, `order_user_id`, `order_shop_id`, `order_total_cost`, `order_total_amount`, `order_create_time`,`payment_order_status`) VALUES (NULL, '" . $cartUserId . "','" . $carts['shop_id'] . "', '" . $carts['total_price'] . "',  '" . $carts['total_amount'] . "', '" . time() . "','1')");
        $orderId = ($link->insert_id);
        $shopIdProduct = $carts['shop_id'];


        $cartCheckoutProduct  = $link->query("SELECT shop.*, cart.*, products.* FROM cart INNER JOIN products ON products.p_id = cart.cart_product_id INNER JOIN shop ON shop.shop_id = products.p_shop_id WHERE cart.cart_user_id = '$cartUserId' AND shop.shop_id = '$shopIdProduct' ");
        var_dump($cartCheckoutProduct);
        $checkOutOrder = array();
        while ($rowOrder = mysqli_fetch_array($cartCheckoutProduct)) {
            $checkOutOrder[] =  $rowOrder;
        }

        $insertString = "";
        foreach ($checkOutOrder  as $key => $cart) {
            $insertString .= "(NULL, '" . $orderId . "', '" . $cart['cart_product_id'] . "', '" . $cart['cart_quantity']  . "', '" . $cart['p_price'] . "', '" . time() . "')";
            if ($key != count($checkOutOrder) - 1) {
                $insertString .=  ",";
            }
        }
        var_dump($insertString);
        $orderDetail = mysqli_query($link, "INSERT INTO `order_items` (`id`, `order_id`, `order_product_id`, `quantity`, `price`, `create_time`) VALUES " . $insertString . ";");


        $orderAddress = $link->query("INSERT INTO `order_address` (`oda_id`, `oda_order_id`, `oda_firstname`, `oda_lastname`, `oda_address`, `oda_address_2`, `oda_phone`, `oda_email`, `oda_country`, `oda_state`, `oda_zip`, `oda_note`, `oda_create_time`) VALUES (NULL, ' $orderId ', ' $_POST[firstName]','$_POST[lastName]','$_POST[address1]','$_POST[address2]','$_POST[phoneNumber]','$_POST[email]','$_POST[selectCountry]','$_POST[selectStates]','$_POST[zipCode]','$_POST[noteCheckout]', '" . time() . "')");
        echo $success = "order thành công";

        var_dump($order);
        var_dump($orderDetail);
        var_dump($orderAddress);
    }

    if (isset($order) && isset($orderDetail)) {
        $link->query("DELETE FROM cart WHERE `cart_user_id` = '$cartUserId'");
    }
}

if (isset($_POST["order_online"])) {


    $_SESSION["username"] = $_POST["username"]
?>
    <script type="text/javascript">
        window.location = "../payment/vnpay_php/index.php";
    </script>
<?php
}
?>