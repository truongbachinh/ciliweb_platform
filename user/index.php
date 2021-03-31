<?php
include "../config_user.php";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
</head>

<body class="sidebar-pinned " style="overflow-x: hidden;">

    <main class="user-main">
        <?php include "../partials/header_user.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->

        <div class="container-fluid">
            <?php
            include('content.php');
            ?>
        </div>



        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>
    <?php include "../partials/footer_user.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {

        })
    </script>
</body>

</html>