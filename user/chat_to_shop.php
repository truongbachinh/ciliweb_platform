<!-- <link rel="stylesheet" href="../user/css/chat.css"> -->
<section class="admin-content">
    <div class="container m-t-30">
        <div class="row justify-content-md-center">
            <div class="col-lg-10">
                <div class="card m-b-30 m-t-60">
                    <div class="wrapper">
                        <section class="users">
                            <header>
                                <div class="content">
                                    <?php
                                    $sql = mysqli_query($link, "SELECT user.*, user_infor.* FROM user LEFT JOIN user_infor ON user_infor.ui_user_id = user.user_id WHERE `user_id` = $userId");
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
            </div>
        </div>
        <div class="modal fade" id="chatToShop" tabindex="-1" role="dialog" aria-labelledby="chatToShop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="chatToShop">Chat with shop</h5>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="wrapper">
                            <section class="chat-area">
                                <header>
                                    <a href="./index.php" onclick="turnOfInterval()" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                                    <img src="" alt="" id="chatToShopAvatar">
                                    <div class="details">
                                        <span id="chatToShopName"></span>
                                        <p id="chatToShopStatus"></p>
                                    </div>
                                </header>
                                <div class="chat-box">

                                </div>
                                <form action="#" class="typing-area">
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
        <script src="./javascript/user.js"></script>
</section>