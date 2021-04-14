<?php
include "../config_shop.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../chat/style.css">
</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside_shop.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header_shop.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->

        <?php if (isset($userId) == true) : ?>
            <div>

                <?php include "../chat/users.php"; ?>
            </div>
        <?php else : ?>
            <div></div>

        <?php endif ?>

        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {

        })
    </script>
</body>

</html>