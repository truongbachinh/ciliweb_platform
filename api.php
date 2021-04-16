<?php
header('Content-Type: application/json');
include "./config.php";
include "./mailer/class.phpmailer.php";
include "./mail_process.php";

$response = array();
$data = [];
$msg = "";
$error = 0;
$action = @$_POST['action'];


// check login and password

// process requests
switch ($action) {
    case "delete_user_info":
        $id = $_POST['id'];
        $query = $link->query("DELETE FROM `user` WHERE `user_id` = '$id'");
        if ($query) {
            $msg = "Record deleted successfully";
        } else {
            $error = 400;
            $msg = "Error delete record: " . $link->error;
        }
        break;
    case "delete_role_info":
        $id = $_POST['id'];
        $query = $link->query("DELETE FROM `role` WHERE `role_id` = '$id'");
        if ($query) {
            $msg = "Record deleted successfully";
        } else {
            $error = 400;
            $msg = "Error delete record: " . $link->error;
        }
        break;
    case "delete_categories_info":
        $id = $_POST['id'];
        $query = $link->query("DELETE FROM `categories` WHERE `ctg_id` = '$id'");
        if ($query) {
            $msg = "Record deleted successfully";
        } else {
            $error = 400;
            $msg = "Error delete record: " . $link->error;
        }
        break;
    case "delete_shop_info":
        $id = $_POST['id'];
        $query = $link->query("DELETE FROM `shop` WHERE `shop_id` = '$id'");
        if ($query) {
            $msg = "Record deleted successfully";
        } else {
            $error = 400;
            $msg = "Error delete record: " . $link->error;
        }
        break;
    case "delete_product_info":
        $id = $_POST['id'];
        $query = $link->query("DELETE FROM `products` WHERE `p_id` = '$id'");
        if ($query) {
            $msg = "Record deleted successfully";
        } else {
            $error = 400;
            $msg = "Error delete record: " . $link->error;
        }
        break;
    case "get_user_info":
        $id = $_POST['id'];
        $query = $link->query("SELECT * FROM `user` WHERE `user_id` = $id");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {
            $data = $query->fetch_assoc();
        }
        break;
    case "get_shop_info":
        $id = $_POST['id'];
        $query = $link->query("SELECT * FROM `shop` WHERE `shop_id` = $id");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {
            $data = $query->fetch_assoc();
        }
        break;
    case "get_categories_info":
        $id = $_POST['id'];
        $query = $link->query("SELECT * FROM `categories` WHERE `ctg_id` = $id");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {
            $data = $query->fetch_assoc();
        }
        break;
    case "get_role_info":
        $id = $_POST['id'];
        $query = $link->query("SELECT * FROM `role` WHERE `role_id` = $id");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {
            $data = $query->fetch_assoc();
        }
        break;
    case "get_user_info_detail":
        $id = $_POST['id'];
        $query = $link->query("SELECT user.*, user_infor.* FROM `user` LEFT JOIN user_infor ON user_infor.ui_user_id = user.user_id WHERE `user_id` = $id");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {
            $data = $query->fetch_assoc();
        }
        break;
    case "get_shop_info_detail":
        $id = $_POST['id'];
        $query = $link->query("SELECT user.*, shop.* FROM `shop` INNER JOIN user ON user.user_id = shop.shop_user_id WHERE `shop_id` = $id");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {
            $data = $query->fetch_assoc();
        }
        break;
    case "get_product_info_detail":
        $id = $_POST['id'];
        $query = $link->query("SELECT products.*, categories.*, image_library.* FROM `products` INNER JOIN categories ON categories.ctg_id = products.p_category_id INNER JOIN image_library ON image_library.img_p_id = products.p_id WHERE `p_id` = '$id'");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {
            $count = 0;
            $count = $query->num_rows;
            for ($i = 0; $i < $count; $i++) {
                $data = $query->fetch_assoc();
            }
        }
        break;
    case "get_order_shipping_info":
        $id = $_POST['id'];
        $query = $link->query("SELECT orders.*, user.* from `orders` inner join user on user.user_id = orders.order_user_id where `id` = '$id'");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {
            $data = $query->fetch_assoc();
        }
        break;
    case "get_order_user_shipping_info":
        $id = $_POST['id'];
        $query = $link->query("SELECT orders.*, user.* from `orders` inner join user on user.user_id = orders.order_user_id where `id` = '$id'");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {
            $data = $query->fetch_assoc();
        }
        break;
    case "get_user_chat_detail":

        $talker = $_POST['id'];
        $userId = $_SESSION["current_user"]["user_id"];
        $user_id = mysqli_real_escape_string($link, $talker);
        $sql = mysqli_query($link, "SELECT user.*, user_infor.* FROM user LEFT JOIN user_infor ON user_infor.ui_user_id = user.user_id WHERE `user_id` = {$talker}");
        if (mysqli_num_rows($sql) > 0) {
            // $row = mysqli_fetch_assoc($sql);
            $data = $sql->fetch_assoc();
        }
        break;

        $id = $_POST['id'];
        break;
    case "feedback_product":
        $id = $_POST['id'];


        $query = $link->query("SELECT products.p_name, products.p_image, shop.shop_name, shop.shop_id  FROM products INNER JOIN shop ON products.p_shop_id = shop.shop_id WHERE products.p_id  = '$id'");
        if ($query->num_rows == 0) {
            $msg = "This file is not available.";
        } else {
            $data = $query->fetch_assoc();
        }
        break;
    case "get_order_info_detail":
        $id = $_POST['id'];
        $query = $link->query("SELECT order_address.*, orders.*, order_items.*,user.*, products.p_name as order_product_name, products.p_image as order_product_image from orders INNER JOIN order_items ON orders.id = order_items.order_id INNER JOIN products ON products.p_id = order_items.order_product_id INNER JOIN user ON user.user_id = orders.order_user_id INNER JOIN order_address ON order_address.oda_order_id = orders.id WHERE orders.id  = '$id'");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This file is not available.";
        } else {

            // $data = $query->fetch_assoc();
            $bill = array();
            while ($dataOrder = $query->fetch_assoc()) {
                $bill[] = $dataOrder;
            }
            foreach ($bill as $order) {

?>
                <div id="view-order-detail">

                    <li>
                        <span><?= $order['order_product_name'] ?></span><br>
                        <span>
                            <?php
                            if ($query->num_rows > 0) {

                                $imageURL = '../shop/image_products/' . $order["order_product_image"];
                            ?>
                                <div>
                                    <img src="<?php echo $imageURL; ?>" alt="" width="70" height="70" class="img-fluid" id="img-view-details" />


                                </div>

                            <?php
                            } else { ?>
                                <p>No image(s) found...</p>
                            <?php } ?>
                        </span>
                        <span>SL: <?= $order['quantity'] ?></span><br>
                        <span>cost: <?= $t = number_format($order['quantity'] * $order['price'], 0, ",", ".") ?>VNĐ </span><br>
                        <span>Payment: Not yet </span><br>
                        <br>
                    </li>
                </div>
<?php
                $totalMoney = $order['order_total_cost'];
                $totalQuantity = $order['order_total_amount'];
            }
        }


        break;
    case "update_user_info":

        $id = $_POST['id'];
        $roleUser = $_POST['editRole'];
        $statusUser = $_POST['editStatus'];
        $update = $link->query("UPDATE `user` SET `user_role_id`= '$roleUser',`user_status`= '$statusUser',`user_update_time`= '" . time() . "' WHERE `user_id`=$id");

        if ($update) {
            $msg = "Record updated successfully";
        } else {
            $error = 400;
            $msg = "Error updating record: " . $link->error;
        }


        break;
    case "update_shop_info":
        $id = $_POST['id'];
        $statusShop = $_POST['editStatusShop'];
        $rankShop = $_POST['editRankShop'];
        $shopTimeUpdate = time();
        $stmt = $link->prepare("UPDATE `shop` SET `shop_status`=?,`shop_rank`=?,`shop_update_time`=? WHERE `shop_id`=?");
        $stmt->bind_param("sssi", $statusShop, $rankShop, $shopTimeUpdate, $id);
        if ($stmt->execute()) {
            $msg = "Record updated successfully";
        } else {
            $error = 400;
            $msg = "Error delete record: " . $link->error;
        }
        break;
        // $update = $link->query("UPDATE `shop` SET `shop_status`= '$statusShop',`shop_rank`= '$rankShop',`shop_update_time`= '" . time() . "' WHERE `shop_id`=$id");

        // if ($update) {
        //     $msg = "Record updated successfully";
        // } else {
        //     $error = 400;
        //     $msg = "Error updating record: " . $link->error;
        // }
        // break;

    case "update_role_info":
        $id = $_POST['id'];
        $roleName = $_POST['editRoleName'];
        $roleDescription = $_POST['editRoleDescription'];
        $roleStatus = $_POST['editRoleStatus'];

        $update = $link->query("UPDATE `role` SET `role_name`= '$roleName',`role_description`= '$roleDescription',`role_status`= '$roleStatus',`role_update_time`= '" . time() . "' WHERE `role_id`=$id");

        if ($update) {
            $msg = "Record updated successfully";
        } else {
            $error = 400;
            $msg = "Error updating record: " . $link->error;
        }
        break;
    case "update_order_shipping_infor":
        $id = $_POST['id'];
        $queryOrder = $link->query("SELECT orders.*, user.* FROM `orders` INNER JOIN user ON user.user_id = orders.order_user_id where `id` = '$id'");
        $orderInfor = mysqli_fetch_assoc($queryOrder);
        $user_order = $orderInfor["username"];
        $total_money_order = $orderInfor["order_total_cost"];
        $order_id_paymeny = time();
        $shippingCreateTime = time();
        $current = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
        $timePayment = $current->format('Y-m-d H:i:s');
        $orderShipping = $_POST['updateOrderShipping'];
        if ($orderShipping == 2) {
            $update = $link->query("UPDATE `orders` SET `shipping_order_status`= '$orderShipping', `shipping_create_time` = '$shippingCreateTime' WHERE `id` = $id");
        } elseif ($orderShipping == 3) {
            $update = $link->query("UPDATE `orders` SET `shipping_order_status`= '$orderShipping', `shipping_receive_time` = '$shippingCreateTime' WHERE `id` = $id");
        } elseif ($orderShipping == 4) {
            $update = $link->query("UPDATE `orders` SET `shipping_order_status`= '$orderShipping', `shipping_cancle_time` = '$shippingCreateTime' WHERE `id` = $id");
        }

        if ($update) {
            $msg = "Record updated successfully";
            $queryEmail = $link->query("SELECT orders.*, user.* FROM orders INNER JOIN `user` ON user.user_id = orders.order_user_id where orders.id = '$id'");
            $userMail = $queryEmail->fetch_assoc();
            $email = $userMail["email"];
            $message = "Shop has sent seafood for you";
            $subject = "Notification from Cili website";
            $text_message    =   "hello";
            send_mail($email, $subject, $message, $text_message);
            if ($orderInfor["payment_order_status"] == 1 && $orderShipping == 3) {
                $sql = "SELECT * FROM payments WHERE payment_order_id = '$id'";
                if (isset($sql)) {
                    $query = mysqli_query($link, $sql);
                    $row = mysqli_num_rows($query);
                }
                if ($row > 0) {
                    $updatePayment  = $link->query("UPDATE `payments` SET  `money` = '$total_money_order', `time` = '$timePayment' WHERE  `payment_order_id` = '$id'");
                } else {
                    $addPayment = $link->query("INSERT INTO `payments` (`id`, `payment_order_id`, `order_id`, `user_order`, `money`, `time`) VALUES (NULL, '$id', '$order_id_paymeny', '$user_order', ' $total_money_order',  '$timePayment');");
                }
            }
            if ($update) {
                $msg = "Record updated successfully";
            }
        } else {
            $error = 400;
            $msg = "Error updating record: " . $link->error;
        }
        break;

    case "update_order_user_shipping_infor":
        $id = $_POST['id'];
        $shippingReceiveTime = time();
        $orderShipping = $_POST['updateShippingStatus'];
        if ($orderShipping == 3) {
            $update = $link->query("UPDATE `orders` SET `shipping_order_status`= '$orderShipping', `shipping_receive_time` = '$shippingReceiveTime' WHERE `id` = $id");
        } elseif ($orderShipping == 4) {
            $update = $link->query("UPDATE `orders` SET `shipping_order_status`= '$orderShipping', `shipping_receive_time` = '$shippingReceiveTime' WHERE `id` = $id");
        } else {
            $update = $link->query("UPDATE `orders` SET `shipping_order_status`= '$orderShipping' WHERE `id` = $id");
        }


        if ($update) {
            $msg = "Record updated successfully";
        } else {
            $error = 400;
            $msg = "Error updating record: " . $link->error;
        }
        break;
    case "update_categories_info":
        $id = $_POST['id'];
        $category = $_POST['editCategory'];
        $ctgDescription = $_POST['editCtgDescription'];
        $ctgStatus = $_POST['editCtgStatus'];
        $ctgTimeUpdate = time();
        $stmt = $link->prepare("UPDATE `categories` SET `ctg_name`=?,`ctg_description`=?,`ctg_status`=?,`ctg_update_time`=? WHERE `ctg_id`=?");
        $stmt->bind_param("ssssi", $category, $ctgDescription, $ctgStatus, $ctgTimeUpdate, $id);
        if ($stmt->execute()) {
            $msg = "Record updated successfully";
        } else {
            $error = 400;
            $msg = "Error delete record: " . $link->error;
        }
        break;

    case "chat_to_shop":
        $talker = $_POST['id'];
        $userId = $_SESSION["current_user"]["user_id"];
        $user_id = mysqli_real_escape_string($link, $talker);
        $sql = mysqli_query($link, "SELECT user.*, shop.* FROM user INNER JOIN shop ON shop.shop_user_id = user.user_id WHERE `user_id` = {$talker}");
        if (mysqli_num_rows($sql) > 0) {
            // $row = mysqli_fetch_assoc($sql);
            $data = $sql->fetch_assoc();
        }
        break;
}



$response["msg"] = $msg;
$response["error"] = $error;
$response["data"] = $data;

echo json_encode($response);
