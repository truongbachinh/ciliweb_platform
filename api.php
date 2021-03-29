<?php
header('Content-Type: application/json');
include "../config.php";

$response = array();
$data = [];
$msg = "";
$error = 0;
$action = @$_POST['action'];


// check login and password

// process requests
switch ($action) {
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
var_dump($data);
exit;


$response["msg"] = $msg;
$response["error"] = $error;
$response["data"] = $data;

echo json_encode($response);
