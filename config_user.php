<?php
include "connect_db.php";
session_start();


$isLoggedInUser = isset($_SESSION['current_user']);
$isLoggedInUserSocial = isset($_SESSION['current_user_social']);
if ($isLoggedInUser) $currentUser = $_SESSION['current_username'];
if ($isLoggedInUserSocial) $currentUser = $_SESSION['current_user_social'];

$userId = $_SESSION["current_user"]["user_id"];
$userSocialId = $_SESSION["current_user_social"]["user_id"];
if (!empty($userId)) {
    $resultUserInfor = mysqli_query($link, "select * from user where user_id = '$userId'");
} elseif (!empty($userSocialId)) {
    $resultUserInfor = mysqli_query($link, "select * from user where user_id = '$userSocialId'");
}

$rowUser = mysqli_fetch_array($resultUserInfor, MYSQLI_ASSOC);
