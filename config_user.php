<?php
include "connect_db.php";
session_start();


$isLoggedInUser = isset($_SESSION['current_user']);

if ($isLoggedInUser) $currentUser = $_SESSION['current_user'];

if ($isLoggedInUser) {
    $userId = $_SESSION["current_user"]["user_id"];
}



if (!empty($userId)) {
    $resultUserInfor = mysqli_query($link, "select * from user_infor where ui_user_id = '$userId'");
}

if (!isset($resultUserInfor)) {
    $rowUser = mysqli_fetch_array($resultUserInfor, MYSQLI_ASSOC);
}
$pageTitle = "Ciliweb Seafood Platform";
