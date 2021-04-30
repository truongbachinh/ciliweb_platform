<?php

if (!isset($_SESSION)) {
    include "../config_user.php";
}

if (!empty($_SESSION["current_user"]['username'])) {

    $cartUserId = $_SESSION["current_user"]['user_id'];
}
if (!empty($_SESSION["current_user"]['fullname'])) {

    $cartUserId = $_SESSION["current_user"]['user_id'];
}
$results = $link->query("SELECT COUNT(cart_id) FROM  cart  WHERE cart_user_id = ' $cartUserId'");
$GLOBALS['countProduct'] = mysqli_fetch_array($results);
?>
<i class="mdi mdi-cart mdi:16px" style="color:floralwhite"><span style="padding: 4px;"><?= $GLOBALS['countProduct'][0]; ?></span></i>