<?php
session_start();
include "./connect_db.php";
if (!empty($_SESSION["current_user"]['username'])) {

    $cartUserId = $_SESSION["current_user"]['user_id'];
}
if (!empty($_SESSION["current_user_social"]['fullname'])) {

    $cartUserId = $_SESSION["current_user_social"]['user_id'];
}

// $shopInfor = $link->query("SELECT shop.*, products.* from products INNER JOIN shop ON shop.shop_id = products.p_shop_id IN (" . implode(",", array_keys($_POST["quantity"])) . ")");
// $GLOBALS['shopInfor'] = mysqli_fetch_assoc($shopInfor);
switch ($_GET['view']) {
    case "add_to_cart":
        if (isset($_POST["quantity"])) {
            $cartResult = $link->query("SELECT products.*, shop.* FROM products INNER JOIN shop ON products.p_shop_id = shop.shop_id IN (" . implode(",", array_keys($_POST["quantity"])) . ")");
            $cartShop = array();
            $productId = "";
            $cartProductPrice = "";
            while ($row = mysqli_fetch_array($cartResult)) {
                $cartShop[] = $row;
                $productId = $row['p_id'];
                $cartProductPrice = $row['p_price'];
            }

            // $insertString = "";
            // foreach ($cartShop as $key => $productShop) {

            //     $insertString .= "(NULL, '" . $cartUserId . "', '" . $productShop['p_id'] . "', '" . $_POST['quantity'][$product["p_id"]] . "', '" . time() . "', '" . time() . "')";
            //     if ($key != count($cartProduct) - 1) {
            //         $insertString .= ",";
            //     }
            // }
            // $cartProductId = "";
            // $cartId = "";
            foreach ($_POST['quantity'] as $id => $quantity) {

                $cartSql = mysqli_query($link, "select * from `cart` where cart_user_id = '$cartUserId' and cart_product_id = '$id' ");
                while ($rowCart = mysqli_fetch_array($cartSql)) {
                    $cartId = $rowCart['cart_id'];
                    $cartAmount = $rowCart["cart_amount"];
                }
                if ($cartId) {
                    $amount = $cartAmount + $_POST['quantity'][$product["p_id"]];
                    // $price = ($cartAmount * $cartProductPrice) + ($_POST['quantity'][$product["p_id"]] * $cartProductPrice);
                    $cartUpdate = mysqli_query($link, "UPDATE `cart` SET `cart_amount` = '" . $amount . "' where cart_id = '$cartId'");
                    echo json_encode(
                        array(
                            'status' => $cartUpdate,
                            'message' => "Update product oke"
                        )
                    );
                } else {
                    $cartDetail = mysqli_query($link, "INSERT INTO `cart` (`cart_id`, `cart_user_id`, `cart_product_id`, `cart_amount`, `create_time`, `update_time`) VALUES " . $insertString . ";");
                    echo json_encode(array(
                        'status' => $cartDetail,
                        'message' => "Add product oke"
                    ));
                }
            }
        }
        break;
    case "delete_cart_item";


        $cId = $_POST['id'];
        $deleteCart =  $link->query("DELETE FROM `cart` WHERE `cart_id` = '$cId ' AND `cart_user_id` = $cartUserId");
        echo json_encode(array(
            'status' => $deleteCart,
            'message' => "delete product oke"
        ));
        break;
    case "update_cart";
        if (isset($_POST["quantity"])) {
            foreach ($_POST['quantity'] as $id => $quantity) {
                $cartUpdate = mysqli_query($link, "UPDATE `cart`  SET `cart_amount`  = '" . $quantity . "'  where cart_user_id = '$cartUserId' AND  cart_id = $id");
            }
            echo json_encode(array(
                'status' => $cartUpdate,
                'message' => "Update cart oke"
            ));
        }
        break;
    default:
        break;
}
