<?php
include "../config_admin.php";
if (!isset($_SESSION['current_user'])) {
    header("location: ./account/login.php");
}

if (isset($_GET['view'])) {
    $t = $_GET['view'];
} else {
    $t = '';
}
$adminId = $_SESSION['current_user']['admin_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->
        <?php
        if ($t == 'changepassword') {
            include('../account/change_password.php');
        }
        ?>

        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {

        })
    </script>
</body>

</html>