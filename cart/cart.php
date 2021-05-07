<?php
include "../config_user.php";

if (!empty($_SESSION["current_user"])) {

    $cartUserId = $_SESSION["current_user"]['user_id'];
}

if (isset($_SESSION["current_user"])  && $_SESSION["current_user"]['user_role_id'] == '2' &&  $_SESSION["current_user"]['user_status'] == '1') {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "../partials/html_header.php"; ?>
        <link rel="stylesheet" href="./css/cart.css">
        <link rel="stylesheet" href="../user/css/my_order.css">
    </head>

    <body class="sidebar-pinned " style="overflow-x: hidden;">

        <main class="user-main">
            <?php include "../partials/header_user.php"; ?>
            <!-- PLACE CODE INSIDE THIS AREA -->
            <div class="container-fluid" style="margin-top: 100px">
                <!-- <div>
                    <p id="cart-title" style="width:30%">Your Cart</p>
                </div> -->
                <div class="justify-content-center align-items-center" id="cart-form">
                    <?php
                    include "ajax_cart_content.php"
                    ?>
                </div>
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
<?php
} else {

    header('location: ../account/login.php');
}
?>