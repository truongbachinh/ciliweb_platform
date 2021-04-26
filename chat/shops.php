<?php

include "../config.php";
$userId = $_SESSION["current_user"]["user_id"];
// $shopIF = $GLOBALS['shopInfor'];
// $shopId = $shopIF['shop_id'];
// exit;

?>




<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="./style.css">
</head>


<body class="sidebar-pinned ">

    <main class="admin-main">


        <!-- PLACE CODE INSIDE THIS AREA -->

        <section class="manage-page">
            <div class="container m-t-20">

                <div class="wrapper">
                    <section class="users">
                        <header>
                            <div class="content">
                                <?php
                                $sql = mysqli_query($link, "SELECT user.*, user_infor.* FROM user INNER JOIN user_infor ON user_infor.ui_user_id = user.user_id WHERE `user_id` = $userId");
                                if (mysqli_num_rows($sql) > 0) {
                                    $row = mysqli_fetch_assoc($sql);
                                }
                                ?>
                                <img src="../user/avatar/<?php echo $row['ui_avatar']; ?>" alt="">
                                <div class="details">
                                    <span><?= $row['username'] ?></span>
                                    <p style="color:blue"><?php echo $row['session_status']; ?></p>
                                </div>
                            </div>
                        </header>
                        <div class="search">
                            <span class="text">Select an user to start chat</span>
                            <input type="text" placeholder="Enter name to search...">
                            <button><i class="fas fa-search"></i></button>
                        </div>
                        <div class="users-list">

                        </div>
                    </section>
                </div>
            </div>

            <script src="../chat/javascript/users.js"></script>


        </section>
        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {


        });
    </script>


</body>

</html>