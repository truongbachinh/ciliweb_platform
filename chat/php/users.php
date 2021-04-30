<?php

include_once "../../config.php";
$userId = $_SESSION["current_user"]["user_id"];
$outgoing_id = $userId;


$shopInfor = $link->query("select * from shop where shop_user_id = $userId ");
$GLOBALS['shopInfor'] = mysqli_fetch_assoc($shopInfor);

$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
$query = $link->query("SELECT user.fullname,user.session_status, user.user_id, user_infor.ui_avatar, chat_messages.* FROM chat_messages
 LEFT JOIN user ON user.user_id = chat_messages.msg_outcoming_id
  LEFT JOIN user_infor ON user.user_id = user_infor.ui_user_id
  WHERE chat_messages.msg_incoming_id = $userId GROUP BY user.user_id ORDER BY `user_id` DESC");

$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
    include_once "data.php";
}
echo $output;
