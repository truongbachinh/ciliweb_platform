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
    case "add_role_info":
        $count = 0;
        $sql_user = "SELECT * from role where role_name ='$_POST[nameRole]'";
        $res = mysqli_query($link, $sql_user) or die(mysqli_error($link));
        $count = mysqli_num_rows($res);
        if ($count > 0) {

            $msg = "Role name is already exist.";
        } else {

            $addRole = $link->query("INSERT INTO `role` (`role_id`,`role_name`,`role_description`, `role_status`,  `role_create_time`) VALUES(NULL,'$_POST[nameRole]','$_POST[descriptionRole]','1','" . time() . "')");

            $msg = "Successfully added role.";
        }
        break;
    case "get_role_info":
        $id = $_POST['id'];
        $query = $conn->query("SELECT * FROM `role` WHERE `role_id` = $id");
        if ($query->num_rows == 0) {
            $error = 1;
            $msg = "This role is not available.";
        } else {
            $data = $query->fetch_assoc();
        }

        break;
}



$response["msg"] = $msg;
$response["error"] = $error;
$response["data"] = $data;

echo json_encode($response);
