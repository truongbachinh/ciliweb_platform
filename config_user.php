<?php
include "connect_db.php";
if (!isset($_SESSION)) {
    session_start();
}



$isLoggedInUser = isset($_SESSION['current_user']);

if ($isLoggedInUser) $currentUser = $_SESSION['current_user'];

if ($isLoggedInUser) {
    $userId = $_SESSION["current_user"]["user_id"];
}



if (!empty($userId)) {
    $resultUserInfor = mysqli_query($link, "SELECT  user.*, user_infor.*  from user_infor INNER JOIN user ON user.user_id = user_infor.ui_user_id WHERE `user_id` = '$userId'");
}

if (isset($resultUserInfor)) {
    $rowUser = mysqli_fetch_array($resultUserInfor, MYSQLI_ASSOC);
}

$pageTitle = "Ciliweb Seafood Platform";
