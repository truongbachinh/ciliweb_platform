<?php
include "connect_db.php";
session_start();

$isLoggedIn = isset($_SESSION['current_admin']);
if ($isLoggedIn) $currentUser = $_SESSION['current_admin'];
$pageTitle = "Ciliweb Seafood Platform";
