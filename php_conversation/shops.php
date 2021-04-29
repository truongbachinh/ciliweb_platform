<?php

include_once "../config.php";
$userId = $_SESSION["current_user"]["user_id"];
$outgoing_id = $userId;


$userInfor = $link->query("SELECT user.*, user_infor.* from user LEFT JOIN user_infor on user.user_id = user_infor.ui_user_id where `user_id` = $userId ");
$GLOBALS['userInfor'] = mysqli_fetch_assoc($userInfor);

// $shopIF = $GLOBALS['shopInfor'];
// $shopId = $shopIF['shop_id'];
$query = $link->query("SELECT user.session_status, user.user_id, shop.shop_avatar,shop.shop_name, chat_messages.* FROM chat_messages
 LEFT JOIN user ON user.user_id = chat_messages.msg_outcoming_id
  LEFT JOIN shop ON shop.shop_user_id = user.user_id
  WHERE chat_messages.msg_incoming_id = $userId GROUP BY user.user_id ORDER BY `user_id` DESC");

$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
    include_once "data_shops.php";
}
echo $output;
