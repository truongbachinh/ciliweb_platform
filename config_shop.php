<?php
include "connect_db.php";
session_start();

$isLoggedIn = isset($_SESSION['current_username']);
$isLoggedInShop = isset($_SESSION['current_user']);
if ($isLoggedIn) $currentUser = $_SESSION['current_username'];
if ($isLoggedInShop) $currentUser = $_SESSION['current_user'];

$userId = $_SESSION["current_user"]["user_id"];

$shopInfor = $link->query("select * from shop where shop_user_id = $userId ");
$GLOBALS['shopInfor'] = mysqli_fetch_assoc($shopInfor);


$pageTitle = "Ciliweb Seafood Platform";

$resultShopInfor = mysqli_query($link, "select * from shop where shop_user_id = '$userId'");
$resultUserInfor = mysqli_query($link, "select * from user where user_id = '$userId'");
$rowShop = mysqli_fetch_array($resultShopInfor, MYSQLI_ASSOC);
$rowUser = mysqli_fetch_array($resultUserInfor, MYSQLI_ASSOC);
