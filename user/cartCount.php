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
$results = $link->query("SELECT COUNT(cart_id) FROM cart_items INNER JOIN cart_shop ON cart_shop.cart_id = cart_items.cart_items_cart_shop_id WHERE cart_user_id = ' $cartUserId'");
$GLOBALS['countProduct'] = mysqli_fetch_array($results);
?>
<i class="fas fa-shopping-cart" style="color:floralwhite"><span style="padding: 4px;"><?= $GLOBALS['countProduct'][0]; ?></span></i>