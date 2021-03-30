<?php
$GLOBALS['session'] = session_start();
include "../../connect_db.php";
include "../header.php";

if (!empty($_SESSION["current_user"]['username'])) {

    $cartUserId = $_SESSION["current_user"]['user_id'];
}
if (!empty($_SESSION["current_user_social"]['fullname'])) {

    $cartUserId = $_SESSION["current_user_social"]['user_id'];
}


if (isset($_SESSION["current_user"]['username']) || isset($_SESSION["current_user_social"]['fullname'])) {
    $error = false;
    $success = false;
    if (isset($_GET["view"])) {
        switch ($_GET['view']) {
            case "add_to_cart";
                if (isset($_POST["quantity"])) {
                    $cart_sql = "select * from products where p_id IN (" . implode(",", array_keys($_POST["quantity"])) . ")";
                    $cartResult = mysqli_query($link, $cart_sql);
                    $cartProduct = array();
                    $productId = "";
                    $cartProductPrice = "";
                    while ($row = mysqli_fetch_array($cartResult)) {
                        $cartProduct[] = $row;
                        $productId = $row['p_id'];
                        $cartProductPrice = $row['p_price'];
                    }

                    $insertString = "";
                    foreach ($cartProduct as $key => $product) {

                        $insertString .= "(NULL, '" . $cartUserId . "', '" . $product['p_id'] . "', '" . $_POST['quantity'][$product["p_id"]] . "',  '" . time() . "', '" . time() . "')";
                        if ($key != count($cartProduct) - 1) {
                            $insertString .= ",";
                        }
                    }
                    $cartProductId = "";
                    $cartId = "";
                    foreach ($_POST['quantity'] as $id => $quantity) {

                        $cartSql = mysqli_query($link, "select * from `cart` where cart_user_id = '$cartUserId' and cart_product_id = '$id' ");
                        while ($rowCart = mysqli_fetch_array($cartSql)) {
                            $cartId = $rowCart['cart_id'];
                            $cartAmount = $rowCart["cart_amount"];
                        }
                        if ($cartId) {
                            $amount = $cartAmount + $_POST['quantity'][$product["p_id"]];
                            $cartUpdate = mysqli_query($link, "UPDATE `cart` SET `cart_amount` = '" . $amount . "' where cart_id = '$cartId'");
                            echo "updateoke";
                        } else {
                            $cartDetail = mysqli_query($link, "INSERT INTO `cart` (`cart_id`, `cart_user_id`, `cart_product_id`, `cart_amount`, `create_time`, `update_time`) VALUES " . $insertString . ";");
                            echo "addoke";
                        }
                    }
                }
                break;
            case "update_cart";
                // if (isset($_POST['update_button'])) {
                //     if (isset($_POST["quantity"])) {

                //         // $cart_sql = "select * from products where p_id IN (" . implode(",", array_keys($_POST["quantity"])) . ")";
                //         // $cartResult = mysqli_query($link, $cart_sql);
                //         // $cartProduct = array();
                //         // $productId = "";
                //         // $cartProductPrice = "";
                //         // while ($row = mysqli_fetch_array($cartResult)) {
                //         //     $cartProduct[] = $row;
                //         //     $productId = $row['p_id'];
                //         //     $cartProductPrice = $row['p_price'];
                //         // }


                //         // $cartSql = mysqli_query($link, "select * from `cart` where cart_user_id = '$cartUserId'");
                //         // $cartPrice = array();
                //         // while ($rowCart = mysqli_fetch_array($cartSql)) {
                //         //     $cart[] = $rowCart;
                //         //     $cartId = $rowCart['cart_id'];
                //         //     $cartProductId = $rowCart['cart_product_id'];
                //         //     $cartAmount = $rowCart["cart_amount"];
                //         //     $cartPrice  = $rowCart["cart_price"];
                //         // }


                //         // $updateString = "";
                //         // foreach ($cart as $key => $productCart) {
                //         //     // $updateString .= "('" . $productCart['cart_id'] . "', '" . $cartUserId . "', '" . $productCart['cart_product_id'] . "', '" . $_POST['quantity'][$productCart["cart_product_id"]] . "', '" . $productCart['cart_price'] . "', '" . time() . "', '" . time() . "')";
                //         //     $updateString .= "(  '" . $_POST['quantity'][$productCart["cart_product_id"]] . "')";


                //         //     if ($key != count($productCart) - 1) {
                //         //         $updateString .= ",";
                //         //     }
                //         // }

                //         // var_dump($cartProductPrice, "cartprice");
                //         // exit;
                //         foreach ($_POST['quantity'] as $id => $quantity) {

                //             $cartUpdate = mysqli_query($link, "UPDATE `cart`  SET `cart_amount`  = '" . $quantity . "'  where cart_user_id = '$cartUserId' AND  cart_id = $id");
                //         }
                //         echo json_encode(array(
                //             'status' => $cartUpdate,
                //             'message' => "Update cart oke"
                //         ));
                //     }
                // }
                if (isset($_POST['order_button'])) {
                    if (empty($_POST['uName'])) {
                        $error = "Input name";
                    } elseif (empty($_POST['uAddress'])) {
                        $error = "Input Addrees";
                    } elseif (empty($_POST['uPhone'])) {
                        $error = "Input Phone";
                    } elseif (empty($_POST['quantity'])) {
                        $error = "Cart NUll";
                    }
                    if ($error == false && !empty($_POST['quantity'])) {


                        // xủ lý giỏ hàng lưu vào db
                        $cart_sql = "SELECT c.cart_id, c.cart_amount, c.cart_user_id, c.cart_product_id, p.p_name, p.p_price, p.p_image from cart as c inner join products as p on. c.cart_product_id = p.p_id where cart_user_id = '$cartUserId'";
                        $result = mysqli_query($link, $cart_sql);

                        $total_cost = 0;
                        $total_amount = 0;
                        $orderProduct = array();
                        while ($row = mysqli_fetch_array($result)) {
                            $orderProduct[] = $row;
                            $total_cost += $row['p_price'] * $row['cart_amount'];
                            $total_amount +=  $row['cart_amount'];
                        }


                        // echo date("d/m/y H:i", 1614411800);datetime show from db

                        $order = mysqli_query($link, "INSERT INTO `orders` (`id`, `order_user_id`, `name`, `address`, `phone`, `note`, `total_cost`, `total_amount`, `create_time`, `update_time`) VALUES (NULL,'$cartUserId', '$_POST[uName]', '$_POST[uAddress]', '$_POST[uPhone]', '$_POST[uNote]', '$total_cost','$total_amount', '" . time() . "','" . time() . "');");
                        $orderId = ($link->insert_id);


                        $insertString = "";


                        foreach ($orderProduct as $key => $cart) {

                            $insertString .= "(NULL, '" . $orderId . "', '" . $cart['cart_product_id'] . "', '" . $cart['cart_amount']  . "', '" . $cart['p_price'] . "', '" . time() . "', '" . time() . "')";
                            if ($key != count($orderProduct) - 1) {
                                $insertString .=  ",";
                            }
                        }

                        $orderDetail = mysqli_query($link, "INSERT INTO `order_detail` (`id`, `order_id`, `order_product_id`, `quantity`, `price`, `create_time`, `update_time`) VALUES " . $insertString . ";");

                        echo $success = "order thành công";
                        //log error sql
                        var_dump($order);
                        var_dump($orderDetail);
                        exit;
                        if (isset($order) && isset($orderDetail)) {
                            $link->query("DELETE FROM cart WHERE `cart_user_id` = '$cartUserId'");
                        }
                    }
                }
                break;
        }
    }

    if (!empty($cartUserId)) {

        $cart_sql = "SELECT c.cart_id, c.cart_amount, c.cart_user_id, c.cart_product_id, p.p_name, p.p_price, p.p_image from cart as c inner join products as p on. c.cart_product_id = p.p_id where cart_user_id = '$cartUserId'";
        $result = mysqli_query($link, $cart_sql);
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
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">

        </script>
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/cart.css">
    </head>

    <body>
        <div class="container-fluid" style="margin-top: 160px">
            <div>
                <p id="cart-title">Your Cart</p>
            </div>
            <div class="justify-content-center align-items-center" id="cart-form">
                <?php
                include "ajax_cart_content.php"
                ?>
            </div>
        </div>

    </body>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </html>

<?php

} else {

    header('location: ../account/login.php');
}
?>
<?php

include "../footer.php";
?>