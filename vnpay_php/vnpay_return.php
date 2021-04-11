<?php
ob_start();
require_once("../config_user.php");
include "../mailer/class.phpmailer.php";
include "../mail_process.php";
$GLOBALS['checkout_infor'] = ($_SESSION["checkout_infor"]);

if (!empty($_SESSION["current_user"]['username'])) {

    $cartUserId = $_SESSION["current_user"]['user_id'];
}
if (!empty($_SESSION["current_user_social"]['fullname'])) {

    $cartUserId = $_SESSION["current_user_social"]['user_id'];
}
// session_start();
// var_dump($cartUserId);
// var_dump($GLOBALS['checkout_infor']);
// exit;
$firstName = $GLOBALS['checkout_infor']["firstName"];
$lastName = $GLOBALS['checkout_infor']["lastName"];
$phoneNumber = $GLOBALS['checkout_infor']["phoneNumber"];
$email = $GLOBALS['checkout_infor']["email"];
$calc_shipping_provinces = $GLOBALS['checkout_infor']["calc_shipping_provinces"];
$calc_shipping_district = $GLOBALS['checkout_infor']["calc_shipping_district"];
$zipCode = $GLOBALS['checkout_infor']["zipCode"];
$address1 = $GLOBALS['checkout_infor']["address1"];
$address2 = $GLOBALS['checkout_infor']["address2"];
$noteCheckout = $GLOBALS['checkout_infor']["noteCheckout"];








?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thông tin thanh toán</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="../assets/jquery-1.11.3.min.js"></script>
</head>

<body>
    <?php
    require_once("./config.php");

    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }
    unset($inputData['vnp_SecureHashType']);
    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . $key . "=" . $value;
        } else {
            $hashData = $hashData . $key . "=" . $value;
            $i = 1;
        }
    }

    //$secureHash = md5($vnp_HashSecret . $hashData);
    $secureHash = hash('sha256', $vnp_HashSecret . $hashData);
    ?>
    <!--Begin display -->
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">Thông tin đơn hàng</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Mã đơn hàng:</label>

                <label><?php echo $_GET['vnp_TxnRef'] ?></label>
            </div>
            <div class="form-group">

                <label>Số tiền:</label>
                <label><?= number_format($_GET['vnp_Amount'] / 100) ?> VNĐ</label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã phản hồi (vnp_ResponseCode):</label>
                <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label><?php echo $_GET['vnp_PayDate'] ?></label>
            </div>
            <div class="form-group">
                <label>Kết quả:</label>
                <label>
                    <?php
                    if ($secureHash == $vnp_SecureHash) {
                        if ($_GET['vnp_ResponseCode'] == '00') {

                            $order_id = $_GET['vnp_TxnRef'];

                            $note = $_GET['vnp_OrderInfo'];
                            $vnp_response_code = $_GET['vnp_ResponseCode'];
                            $code_vnpay = $_GET['vnp_TransactionNo'];
                            $code_bank = $_GET['vnp_BankCode'];
                            $time = $_GET['vnp_PayDate'];
                            $date_time = substr($time, 0, 4) . '-' . substr($time, 4, 2) . '-' . substr($time, 6, 2) . ' ' . substr($time, 8, 2) . ' ' . substr($time, 10, 2) . ' ' . substr($time, 12, 2);
                            // var_dump($date_time);
                            // exit;
                            include("./index.php");
                            $taikhoan = $_SESSION["current_user"]['username'];

                            $cartOrder = $link->query("SELECT shop.*, c.cart_id, SUM(c.cart_quantity) as total_amount, c.cart_user_id, c.cart_product_id, p.p_name, SUM(p.p_price) as total_price, p_fresh, p.p_image from cart as c inner join products as p on. c.cart_product_id = p.p_id inner join shop on p.p_shop_id = shop.shop_id where cart_user_id = '$cartUserId' GROUP BY shop.shop_id");
                            $cartInforOrder = array();
                            while ($rowCart = mysqli_fetch_array($cartOrder)) {
                                $cartInforOrder[] =  $rowCart;
                            }
                            $insertOrderString = "";
                            foreach ($cartInforOrder  as $keys => $carts) {

                                $order = $link->query("INSERT INTO `orders` (`id`, `order_user_id`, `order_shop_id`, `order_total_cost`, `order_total_amount`, `order_create_time`,`payment_order_status`,`shipping_order_status`) VALUES (NULL, '" . $cartUserId . "','" . $carts['shop_id'] . "', '" . $carts['total_price'] . "',  '" . $carts['total_amount'] . "', '" . time() . "','2','1')");
                                $orderId = ($link->insert_id);
                                $shopIdProduct = $carts['shop_id'];

                                $cartProduct = $link->query("SELECT cart.*, products.*, shop.* from cart INNER JOIN products on cart.cart_product_id = products.p_id INNER JOIN shop ON shop.shop_id = products.p_shop_id where cart_user_id ='$cartUserId' and shop_id = '$shopIdProduct'");
                                $myCartProduct = array();
                                while ($rowCartProduct = mysqli_fetch_array($cartProduct)) {
                                    $myCartProduct[] =  $rowCartProduct;
                                }
                                $total = 0;
                                $totalCost = 0;
                                foreach ($myCartProduct  as $rowMyCartProduct) {
                                    $total += $rowMyCartProduct["cart_quantity"] *  $rowMyCartProduct["p_price"];
                                }
                                $totalCost += $total;

                                // var_dump("total cost", $totalCost);


                                $cartCheckoutProduct  = $link->query("SELECT shop.*, cart.*, products.* FROM cart INNER JOIN products ON products.p_id = cart.cart_product_id INNER JOIN shop ON shop.shop_id = products.p_shop_id WHERE cart.cart_user_id = '$cartUserId' AND shop.shop_id = '$shopIdProduct' ");
                                // var_dump($cartCheckoutProduct);
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
                                // var_dump($insertString);
                                $orderDetail = mysqli_query($link, "INSERT INTO `order_items` (`id`, `order_id`, `order_product_id`, `quantity`, `price`, `create_time`) VALUES " . $insertString . ";");


                                $orderAddress = $link->query("INSERT INTO `order_address` (`oda_id`, `oda_order_id`, `oda_firstname`, `oda_lastname`, `oda_address`, `oda_address_2`, `oda_phone`, `oda_email`, `oda_city`, `oda_district`, `oda_zip`, `oda_note`, `oda_create_time`) VALUES (NULL, ' $orderId ', ' $firstName','$lastName','$address1','$address2','$phoneNumber','$email','$calc_shipping_provinces','$calc_shipping_district','$zipCode','$noteCheckout', '" . time() . "')");
                                // echo $success = "order thành công";


                                $orderPayment = $link->query("INSERT INTO `payments` (`order_id`,`payment_order_id`, `user_order`, `money`, `note`, `vnp_response_code`,`code_vnpay`, `code_bank`, `time`) VALUES ('$order_id','$orderId', '$taikhoan', '  $totalCost', '$note', '$vnp_response_code', '$code_vnpay', '$code_bank','$date_time')");


                                var_dump($order);
                                var_dump($orderDetail);
                                var_dump($orderAddress);
                                var_dump($orderPayment);


                                // echo "Order successfully";
                                // $sql = "SELECT * FROM payments WHERE order_id = '$order_id'";
                                // if (isset($sql)) {
                                //     $query = mysqli_query($link, $sql);
                                //     $row = mysqli_num_rows($query);
                                // }







                                // if ($row > 0) {
                                //     $sql = "UPDATE payments SET order_id = '$order_id', money = '$money', note = '$note', vnp_response_code = '$vnp_response_code', code_vnpay = '$code_vnpay', code_bank = '$code_bank' WHERE order_id = '$order_id' and payment_order_id = '$orderId'";

                                //     $updatePayment =  mysqli_query($link, $sql);
                                // } else {

                                //     $sql = "INSERT INTO payments(order_id,payment_order_id, member, money, note, vnp_response_code, code_vnpay, code_bank, time) VALUES ('$order_id','$orderId', '$taikhoan', '$money', '$note', '$vnp_response_code', '$code_vnpay', '$code_bank','$date_time')";
                                //     $addPayment =  mysqli_query($link, $sql);
                                // }
                            }
                            if (isset($order) && isset($orderDetail) && isset($orderAddress) && ($orderPayment)) {
                    ?>
                                <script>
                                    swal("Notice", "Order successfully!", "success").then(function(e) {

                                        location.replace("../user/index.php");
                                    });
                                </script>

                    <?php
                                $email = $_SESSION["current_user"]["email"];
                                $message = "You are buy seafood from cili website with payment online";
                                $subject = "Notification from Cili website";
                                $text_message    =   "hello";
                                send_mail($email, $subject, $message, $text_message);
                                $link->query("DELETE FROM cart WHERE `cart_user_id` = '$cartUserId'");
                            }
                        } else {
                            echo "Order un-successfully";
                        }
                    } else {
                        echo "Chu ky khong hop le";
                    }
                    ?>

                </label>
                <br>
                <!-- <a href="https://ciliweb.vn/ciliweb_project/user/index.php">
                    <button>Quay lại</button>
                </a> -->
            </div>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; Ciliweb.vn</p>
        </footer>
    </div>
</body>

</html>