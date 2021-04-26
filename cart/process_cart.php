<?php
include "../config_user.php";

if (!isset($_SESSION)) {
    include "../account/login.php";
}
if (!empty($_SESSION["current_user"])) {

    $cartUserId = $_SESSION["current_user"]['user_id'];
}


switch ($_GET['view']) {
    case "add_to_cart":
        if (isset($_POST["quantity"])) {

            $cartResult = $link->query("SELECT * FROM products WHERE p_id IN (" . implode(",", array_keys($_POST["quantity"])) . ")");
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

                $insertString .= "(NULL, '" . $cartUserId . "', '" . $product['p_id'] . "', '" . $_POST['quantity'][$product["p_id"]] . "', '" . time() . "')";
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
                    $cartAmount = $rowCart["cart_quantity"];
                }
                if ($cartId) {
                    $amount = $cartAmount + $_POST['quantity'][$product["p_id"]];
                    // $price = ($cartAmount * $cartProductPrice) + ($_POST['quantity'][$product["p_id"]] * $cartProductPrice);
                    $cartUpdate = mysqli_query($link, "UPDATE `cart` SET `cart_quantity` = '" . $amount . "', `cart_update_time` = '" . time() . "' where cart_id = '$cartId'");
                    echo json_encode(
                        array(
                            'status' => $cartUpdate,
                            'message' => "Update product oke"
                        )
                    );
                } else {
                    $cartDetail = mysqli_query($link, "INSERT INTO `cart` (`cart_id`, `cart_user_id`, `cart_product_id`, `cart_quantity`, `cart_create_time`) VALUES " . $insertString . ";");
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
    case "delete_all_item";

        $deleteAllItem =  $link->query("DELETE  FROM `cart`  WHERE `cart_user_id` = $cartUserId ");
        echo json_encode(array(
            'status' => $deleteAllItem,
            'message' => "Delete product of shop successfully"
        ));
        break;
    case "update_cart";
        if (isset($_POST["quantity"])) {
            foreach ($_POST['quantity'] as $id => $quantity) {
                $cartUpdate = mysqli_query($link, "UPDATE `cart`  SET `cart_quantity`  = '" . $quantity . "', `cart_update_time` = '" . time() . "'  where cart_user_id = '$cartUserId' AND  cart_id = $id");
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
