<?php
include "connect_db.php";
session_start();

$isLoggedIn = isset($_SESSION['current_user']);
if ($isLoggedIn) $currentUser = $_SESSION['current_user'];
if ($currentUser) {
    $adminId = $_SESSION["current_user"]["admin_id"];
}

$pageTitle = "Ciliweb Seafood Platform";
