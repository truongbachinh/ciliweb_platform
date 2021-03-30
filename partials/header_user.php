<header class="admin-header">
    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
    <nav class=" ml-auto">
        <ul class="nav align-items-center m-r-30">
            <li class=nav-item>
                <div class="d-flex p-all-15  justify-content-between">
                    <a href="#!" class="nar-link"><i class="mdi mdi-24px mdi-chat"></i>
                        <!-- <span class="notification-counter"></span></a> -->
            </li>
            <?php if (!empty($_SESSION["current_user"]["username"])) : ?>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                            <?php
                            if ($resultShopInfor->num_rows > 0) {
                                $imageURL = '../shop/image_shop/' . $rowShop["shop_avatar"];
                            ?>
                                <img class="avatar-img rounded-circle" src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                            <?php
                            } else { ?>
                                <span class="avatar-title rounded-circle bg-dark">CiliWeb</span>

                            <?php } ?>


                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right">
                        <a href="/user/profile.php" class="dropdown-item"> Profile</a>
                        <a href="/user/change-password.php" class="dropdown-item"> Reset Password</a>
                        <a class="dropdown-item" href=""> Help </a>
                        <div class="dropdown-divider"></div>
                        <a href="../account/logout.php" class="dropdown-item"> Logout</a>
                    </div>
                </li>
                <div class="nav-item m-r-3">
                    <a href="#">
                        <b><?= $_SESSION['current_user']['username'] ?></b>
                    </a>
                </div>
            <?php else : ?>
                <li class="nav-item m-r-3">
                    <a href="../account/login.php" class="btn btn-dark">Login</a>
                </li>
            <?php endif; ?>
        </ul>

    </nav>
</header>