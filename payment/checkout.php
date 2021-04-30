<?php
include "../config.php";
include "../mailer/class.phpmailer.php";
include "../mail_process.php";

if (!empty($_SESSION["current_user"])) {

    $cartUserId = $_SESSION["current_user"]['user_id'];
} else {
?>
    <script>
        window.location.replace("../account/login.php");
    </script>
<?php
}

$resultCart = $link->query("SELECT shop.*, cart.*, products.* FROM cart INNER JOIN products ON products.p_id = cart.cart_product_id INNER JOIN shop ON shop.shop_id = products.p_shop_id WHERE cart.cart_user_id   = '$cartUserId'");
$cartInforCheckout = array();
while ($rowC = mysqli_fetch_array($resultCart)) {
    $cartInforCheckout[] =  $rowC;
}

$rowProduct = array();
$result = $link->query("SELECT cart.*, products.*, shop.* from cart INNER JOIN products on cart.cart_product_id = products.p_id INNER JOIN shop ON shop.shop_id = products.p_shop_id where cart_user_id ='$cartUserId' GROUP BY shop.shop_id");
$cartShopInfor = array();
while ($rowShop = mysqli_fetch_array($result)) {
    $cartShopInfor[] =  $rowShop;
}


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
    <link rel="stylesheet" href="../assets/css/error.css">
</head>

<body>
    <div>
        <?php
        include "header_payment.php";
        ?>
    </div>
    <div id="order-form">
        <div class="container">
            <div class="py-5 text-center">

                <h2>Checkout form</h2>
                <p class="lead">Below is form checkout of seafoodweb please field information bellow to order.</p>
            </div>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4 checkout-cart">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Cart summary</span>
                        <span class="badge badge-secondary badge-pill"><?= count($cartInforCheckout) ?></span>
                    </h4>
                    <hr>
                    <ul class="list-group mb-3">
                        <?php
                        $totalCountCheckout = 0;
                        $totalCostCheckout = 0;


                        // $ctG = array();
                        $countShop = array();
                        foreach ($cartShopInfor as $rowShop) {
                            $rowShopId = $rowShop['shop_id'];
                            $cartProduct = $link->query("SELECT cart.*, products.*, shop.* from cart INNER JOIN products on cart.cart_product_id = products.p_id INNER JOIN shop ON shop.shop_id = products.p_shop_id where cart_user_id ='$cartUserId' and shop_id = '$rowShopId'");
                            $myCartProduct = array();
                            while ($rowCartProduct = mysqli_fetch_array($cartProduct)) {
                                $myCartProduct[] =  $rowCartProduct;
                            }
                        ?>

                            <div id="cart-shop">
                                <div style="margin-top: 35px;"><img src="../shop/image_shop/<?= $rowShop['shop_avatar'] ?>" width="60" height="70">
                                </div>
                                <div id="breadcrumb"><i class="fa fas-home" style="margin-left: 9px;"> Order of shop <i class="mdi mdi-arrow-right mdi-14px "></i><?php echo "<font>" . $rowShop['shop_name'] . "</font>" ?></a></i>
                                </div>

                                <?php
                                $total = 0;
                                $totalCost = 0;
                                $count = 0;
                                $totalCount = 0;
                                $i = 1;
                                foreach ($myCartProduct  as $rowMyCartProduct) {

                                ?>

                                    <!-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div class="d-flex flex-column">
                                    <h6 class="my-0">Product Infor</h6>
                                    <div id="avatar-products" class=" my-2">
                                        <img src="../shop/image_products/<?php echo $rowMyCartProduct['p_image'] ?>"
                                            style=" border-radius:5px " width="60" height="60" id="img-infor"
                                            class="img-fluid  ">
                                    </div>
                                    <small class="text-muted">Name: <?= $rowMyCartProduct['p_name'] ?></small>
                                    <small class="text-muted">Quantity:
                                        <?= $quantity = $rowMyCartProduct['cart_quantity'] ?></small>
                                    <small class="text-muted">Shop: <?= $rowMyCartProduct['shop_name'] ?></small>
                                </div>
                                <span
                                    class="text-muted"><?= number_format($cost  = $rowMyCartProduct["cart_quantity"] *  $rowMyCartProduct["p_price"], 0, ",", ".") . ' VNĐ' ?></span>
                            </li> -->
                                <?php
                                    number_format($cost  = $rowMyCartProduct["cart_quantity"] *  $rowMyCartProduct["p_price"], 0, ",", ".");
                                    $total += $cost;
                                    $count += $quantity;
                                }
                                $totalCost += $total;
                                $totalCount += $count;

                                ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total cost</span>
                                    <strong><?= number_format($total, 0, ",", ".") ?>VNĐ</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total Quantity</span>
                                    <strong><?= $count ?></strong>
                                </li>

                            <?php
                            $totalCostCheckout += $totalCost;
                            $totalCountCheckout +=  $totalCount;
                        }

                            ?>

                            </div>
                    </ul>
                    <hr>
                    <div class="card" id="cartTotal">
                        <h3>Total</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item  d-flex justify-content-between"> <span>Total All</span>
                                <strong><?= $costOnline = number_format($totalCostCheckout, 0, ",", ".")  ?>VNĐ</strong>
                            </li>
                            <li class="list-group-item  d-flex justify-content-between"> <span>Total Quantity</span>
                                <strong><?= $totalCountCheckout ?></strong>
                            </li>

                        </ul>
                    </div>
                    <!-- <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Redeem</button>
                            </div>
                        </div>
                    </form> -->
                </div>

                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form method="post" name="formCheckout" id="formCheckoutProduct" action="" class="needs-validation" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phoneNumber">Phone number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i style="color:#f9b34c;" class="fas fa-phone-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="phoneNumber" required>
                            </div>
                            <label for="phoneNumber" class="error"></label>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                            </div>
                            <label for="email" class="error"></label>

                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">City</label>
                                <select class="custom-select d-block w-100" name="calc_shipping_provinces" required>
                                    <option value="">Province / City</option>
                                </select>
                                <input class="billing_address_1" name="" type="hidden" value="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">District</label>
                                <select class="custom-select d-block w-100" name="calc_shipping_district" required>
                                    <option value="">Township / District</option>
                                </select>
                                <input class="billing_address_2" name="" type="hidden" value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zipCode" placeholder="" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i style="color:#f9b34c;" class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="address" name="address1" placeholder="1234 Main St" required>
                            </div>
                            <label for="address" class="error"></label>
                        </div>

                        <div class="mb-3">
                            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i style="color:#f9b34c;" class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
                            </div>
                            <label for="address2" class="error"></label>
                        </div>


                        <div class="mb-3">
                            <label for="address2">Note <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i style="color:#f9b34c;" class="fas fa-clipboard"></i></span>
                                </div>
                                <textarea type="text" name="noteCheckout" class="form-control" id="noteCheckout" placeholder="Apartment or suite"></textarea>
                            </div>
                            <label for="noteCheckout" class="error"></label>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="same-address">
                            <label class="custom-control-label" for="same-address">Shipping address is the same as my
                                billing address</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">Save this information for next
                                time</label>
                        </div>
                        <hr class="mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <button class="btn btn-primary px-3 btn-lg btn-block rounded-pill" type="submit" name="buttonCheckout">Continue to
                                    checkout</button>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button class="btn btn-warning px-3 btn-lg btn-block rounded-pill" type="submit" name="buttonOnlinePayment">
                                    Online payment</button>
                            </div>


                        </div>
                    </form>
                </div>

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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <!-- Popper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->

    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <!-- fancybox -->
    <!-- <script type="text/javascript" src="./library/fancybox/jquery.fancybox.min.js"></script> -->
    <?php include "../partials/js_libs.php"; ?>
    <script src="./js/checkout.js"></script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("valueNotEquals", function(value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");

            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-z," "]+$/i.test(value);
            }, "Letters and spaces only please");
            $('#formCheckoutProduct').validate({
                rules: {
                    firstName: {
                        required: true,
                        lettersOnly: true,
                    },
                    lastName: {
                        required: true,
                        lettersOnly: true,
                    },
                    phoneNumber: {
                        required: true,
                        number: true,
                        maxlength: 14
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    calc_shipping_provinces: {
                        required: true
                    },
                    calc_shipping_district: {
                        required: true
                    },
                    zipCode: {
                        required: true
                    },
                    address1: {
                        required: true
                    }


                },
                messages: {
                    firstName: {
                        required: "Please provide information!",
                        lettersOnly: "Please provide only character in alphabet!",
                    },
                    lastName: {
                        required: "Please provide information!",
                        lettersOnly: "Please provide only character in alphabet!",
                    },
                    phoneNumber: {
                        required: "Please provide your phone number!",
                        minlength: "Please provide at less than 14 number.",
                    },
                    email: {
                        required: "Please provide email!",
                        email: "Please provide an email correct.",
                    },
                    calc_shipping_district: {
                        required: "Please select a district!",
                    },
                    calc_shipping_provinces: {
                        required: "Please select  a provinces!",
                    },
                    zipCode: {
                        required: "Please provide  a zipCode!",
                    },
                    address1: {
                        required: "Please provide  an address!",
                    }


                },
            })
        })
        $(document).on('click', '.buttonOnlinePayment', function(e) {
            e.preventDefault();
            console.log("data", $(this).serializeArray());
        });
    </script>
</body>

</html>

<?php


if (isset($_POST["buttonOnlinePayment"])) {
    $_SESSION["checkout_infor"] = $_POST;
    $_SESSION["cost-online"] = $costOnline;
?>
    <script type="text/javascript">
        window.location = "../vnpay_php/index.php";
    </script>
    <?php
}

if (isset($_POST["buttonCheckout"])) {



    // // xủ lý giỏ hàng lưu vào db

    $cartOrder = $link->query("SELECT shop.*, c.cart_id, SUM(c.cart_quantity) as total_amount, c.cart_user_id, c.cart_product_id, p.p_name, SUM(p.p_price * c.cart_quantity) as total_price, p_fresh, p.p_image from cart as c inner join products as p on. c.cart_product_id = p.p_id inner join shop on p.p_shop_id = shop.shop_id where cart_user_id = '$cartUserId' GROUP BY shop.shop_id");
    $cartInforOrder = array();
    while ($rowCart = mysqli_fetch_array($cartOrder)) {
        $cartInforOrder[] =  $rowCart;
    }

    $insertOrderString = "";



    foreach ($cartInforOrder  as $keys => $carts) {
        $order = $link->query("INSERT INTO `orders` (`id`, `order_user_id`, `order_shop_id`, `order_total_cost`, `order_total_amount`, `order_create_time`,`payment_order_status`,`shipping_order_status`) VALUES (NULL, '" . $cartUserId . "','" . $carts['shop_id'] . "', '" . $carts['total_price'] . "',  '" . $carts['total_amount'] . "', '" .  $timeInVietNam . "','1','1')");
        $orderId = ($link->insert_id);
        $shopIdProduct = $carts['shop_id'];


        $selectUserMail = $link->query("SELECT user.email from user inner join shop on shop.shop_user_id = user.user_id where shop_id = '    $shopIdProduct '");
        $emailShop = $selectUserMail->fetch_assoc();

        $email = $emailShop['email'];
        $message = "You already have an order for new seafood products with delivery payment method. Please visit http://ciliweb.infinityfreeapp.com/ website to check";
        $subject = "Notification from Cili website";
        $text_message    =   "...!";
        send_mail($email, $subject, $message, $text_message);

        $cartCheckoutProduct  = $link->query("SELECT shop.*, cart.*, products.* FROM cart INNER JOIN products ON products.p_id = cart.cart_product_id INNER JOIN shop ON shop.shop_id = products.p_shop_id WHERE cart.cart_user_id = '$cartUserId' AND shop.shop_id = '$shopIdProduct' ");
        //var_dump($cartCheckoutProduct);
        $checkOutOrder = array();
        $checkOutP = array();
        while ($rowOrder = mysqli_fetch_array($cartCheckoutProduct)) {
            $checkOutOrder[] =  $rowOrder;
        }


        $insertString = "";
        $updateQuantity = "";
        $py = "";
        foreach ($checkOutOrder  as $key => $cart) {

            $insertString .= "(NULL, '" . $orderId . "', '" . $cart['cart_product_id'] . "', '" . $cart['cart_quantity']  . "', '" . $cart['p_price'] . "', '" . $timeInVietNam . "')";
            if ($key != count($checkOutOrder) - 1) {
                $insertString .=  ",";
            }

            $caculateQuantity = ($cart['p_quantity'] -  $cart['cart_quantity']);
            $updateQuantityProduct = $link->query("UPDATE products SET p_quantity =  $caculateQuantity WHERE p_id = '$cart[p_id]'");
        }

        // var_dump($updateQuantityProduct);
        // var_dump($updateQuantity < $cart['p_id']);
        // var_dump($updateQuantity);


        // exit;
        $orderDetail = mysqli_query($link, "INSERT INTO `order_items` (`id`, `order_id`, `order_product_id`, `quantity`, `price`, `create_time`) VALUES " . $insertString . ";");

        // if ($orderDetail == true) {

        //     // $updateQuantityProduct = $link->query("UPDATE products SET p_quantity = ");
        //     $stmt = $link->query("UPDATE `products` SET `p_quantity`= $updateQuantity WHERE `p_id`=$py");

        //     $stmt = $conn->prepare("UPDATE `submission` SET `submission_id`=?,`submission_name`=?,`submission_description`=?,`submission_deadline`=? WHERE `id`=?");
        //     $stmt->bind_param("ssssi", $submissionCode, $submissionName, $description, $deadline, $id);
        //     if ($stmt->execute()) {
        //         $msg = "Record updated successfully";
        //     }
        // }

        $orderAddress = $link->query("INSERT INTO `order_address` (`oda_id`, `oda_order_id`, `oda_firstname`, `oda_lastname`, `oda_address`, `oda_address_2`, `oda_phone`, `oda_email`, `oda_city`, `oda_district`, `oda_zip`, `oda_note`, `oda_create_time`) VALUES (NULL, ' $orderId ', ' $_POST[firstName]','$_POST[lastName]','$_POST[address1]','$_POST[address2]','$_POST[phoneNumber]','$_POST[email]','$_POST[calc_shipping_provinces]','$_POST[calc_shipping_district]','$_POST[zipCode]','$_POST[noteCheckout]', '" . $timeInVietNam . "')");
        // echo $success = "order thành công";
        // var_dump($stmt);
        // var_dump($order);
        // var_dump($orderDetail);
        // var_dump($orderAddress);
    }
    // exit;
    if (isset($order) && isset($orderDetail) && isset($orderAddress)) {
    ?>
        <script>
            document.getElementById("cartTotal").style.display = "none";
            swal("Notice", "Order successfully!", "success").then(function(e) {

                location.replace("../user/index.php");
            });
        </script>

<?php
        $email = $_SESSION["current_user"]["email"];
        $message = "You are buy seafood from cili website";
        $subject = "Notification from Cili website";
        $text_message    =   "hello";
        send_mail($email, $subject, $message, $text_message);
        $link->query("DELETE FROM cart WHERE `cart_user_id` = '$cartUserId'");
    }
}


?>