<?php
include "../config_shop.php";

// var_dump($userId);
// exit;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
    <link rel="stylesheet" href="./css/chat.css">
</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside_shop.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header_shop.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->

        <?php if (isset($userId) == true) : ?>
            <section class="admin-content">
                <div class="container m-t-30">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-10">
                            <div class="card m-b-30">
                                <div class="wrapper">
                                    <section class="users">
                                        <header>
                                            <div class="content">
                                                <?php
                                                $sql = mysqli_query($link, "SELECT user.*, shop.* FROM user INNER JOIN shop ON shop.shop_user_id = user.user_id WHERE `user_id` = $userId");
                                                if (mysqli_num_rows($sql) > 0) {
                                                    $row = mysqli_fetch_assoc($sql);
                                                }
                                                ?>
                                                <img src="../shop/image_shop/<?php echo $row['shop_avatar']; ?>" alt="">
                                                <div class="details">
                                                    <span><?= $row['shop_name'] ?></span>
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
                        </div>
                    </div>
                    <div class=" modal fade" id="chatToUserForm" tabindex="-1" role="dialog" aria-labelledby="chatToUserForm" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="chatToUserForm">Chat with user</h5>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="wrapper">
                                        <section class="chat-area">
                                            <header>
                                                <a href="./chat_to_user.php" class="back-icon" onclick="turnOfInterval()"><i class="fas fa-arrow-left"></i></a>
                                                <img src="" alt="" id="chatToUserAvatar">
                                                <div class="details">
                                                    <span id="chatToUserName"></span>
                                                    <p id="chatToUserStatus"></p>

                                                </div>
                                            </header>
                                            <div class="chat-box">

                                            </div>
                                            <form action="#" class="typing-area" onsubmit="myFunction()">
                                                <input type="text" class="incoming_id" name="incoming_id" id="incoming_id" value="" hidden>
                                                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                                                <button><i class="fab fa-telegram-plane"></i></button>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="./javascript/users.js"></script>
            </section>
        <?php else : ?>
            <?php
            header('location: ../account/login.php');
            ?>
        <?php endif ?>

        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {
            var userId = null

            $(document).on('click', '.btn-chat-user', function(e) {

                e.preventDefault();
                var pathFile = "../user/avatar/";
                const userId = parseInt($(this).data("id"));
                console.log("addd", userId);
                $('#chatToUserForm').modal();
                Utils.api('get_user_chat_detail', {
                    id: userId
                }).then(response => {
                    $('#chatToUserAvatar').attr('src', pathFile.concat(response.data.ui_avatar));
                    $("#chatToUserName").text(response.data.fullname);
                    $("#chatToUserStatus").text(response.data.session_status);
                    $('input[id=incoming_id]').attr('value', response.data.user_id);
                    $('#chatToUserForm').modal();
                }).catch(err => {})

                setTimeout(() => {
                    MyFunction();
                }, 1000);

            })

        });

        function turnOfInterval() {
            console.log("Setinter oke");
            window.location.replace = "./chat_to_user.php";
        }
    </script>
    <script src="./javascript/chat.js"></script>


</body>

</html>