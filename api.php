<?php
header('Content-Type: application/json');
include "./config.php";

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

            // $datass = array();
            // while ($datas = $query->fetch_assoc()) {
            //     $datass[] = $datas;
            // }
        }

        break;
    case "get_oder_info_detail":
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

            // $datass = array();
            // while ($datas = $query->fetch_assoc()) {
            //     $datass[] = $datas;
            // }
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
}



$response["msg"] = $msg;
$response["error"] = $error;
$response["data"] = $data;

echo json_encode($response);
