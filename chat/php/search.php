<?php
include_once "../../config.php";
$outgoing_id = $userId;


$searchTerm = mysqli_real_escape_string($link, $_POST['searchTerm']);

$sql = "SELECT user.fullname,user.session_status, user.user_id, user_infor.ui_avatar, orders.id, orders.shipping_order_status, shop.* FROM user INNER JOIN orders ON orders.order_user_id = user.user_id LEFT JOIN user_infor ON user_infor.ui_user_id = user.user_id INNER JOIN shop ON shop.shop_id = orders.order_shop_id GROUP BY user.user_id AND (user.username LIKE '%{$searchTerm}%' ) ";


$output = "";
$query = mysqli_query($link, $sql);
if (mysqli_num_rows($query) > 0) {
    include_once "data.php";
} else {
    $output .= 'No user found related to your search term';
}
echo $output;
