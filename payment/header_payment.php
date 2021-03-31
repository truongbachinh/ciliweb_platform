<!-- Main Navigation -->
<link rel="stylesheet" href="./css/header_payment.css">
<?php

include "../config_user.php";

if (!empty($_SESSION["current_user"])) {


    // $cartUId = $_SESSION["current_user"]['user_id'];
    // $results = $link->query("SELECT COUNT(cart_id) FROM cart WHERE cart_user_id = ' $cartUId'");
    // $countProduct = mysqli_fetch_array($results);



?>
    <div class="header-content">
        <nav class="navbar navbar-expand-lg bg-nav">
            <a class="navbar-brand" href="https://ciliweb.vn/ciliweb_project/user/index.php" id="logo-brand">
                <i class="fas fa-home"></i> Seller channel
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ciliweb-navBar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="ciliweb-navBar">
                <ul class="navbar-nav ml-auto ">

                </ul>



                <ul class="navbar-nav ">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-sm avatar-online">
                                <?php
                                if ($resultUserInfor->num_rows > 0) {
                                    $imageURL = '../user/avatar/' . $rowUser["ui_avatar"];
                                ?>
                                    <img class="avatar-img rounded-circle" src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                <?php
                                } else { ?>
                                    <span class="avatar-title rounded-circle bg-warning"><?php echo $_SESSION["current_user"]["username"]; ?></span>

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
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg bg-nav">
            <a class="navbar-brand" href="../user/index.php">
                <img src="https://ciliweb.vn/ciliweb_project/user/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="75" height="75">
            </a>
            <div class="collapse navbar-collapse">
            </div>
        </nav>



    </div>

<?php
} elseif (!empty($_SESSION["current_user_social"])) {
    // $cartUId = $_SESSION["current_user_social"]['user_id'];
    // $countProduct = $link->query("SELECT COUNT(cart_id) FROM cart WHERE cart_user_id = ' $cartUId'");

?>
    <div>
        <nav class=" navbar navbar-expand-lg " style="  background-color:  #fa4956 !important;">
            <a class="navbar-brand" href="https://ciliweb.vn/ciliweb_project/user/index.php" id="logo-brand">
                <i class="fas fa-home"></i> Seller channel
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ciliweb-navBar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="ciliweb-navBar">
                <ul class="navbar-nav ml-auto ">

                </ul>
                <?php

                ?>
                <ul class="navbar-nav ">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="https://ciliweb.vn/ciliweb_project/user/account/profile.php" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="d-inline-flex">
                                <div class="avatar avatar-sm avatar-online mr-3">
                                    <span class="avatar-title rounded-circle"><i class="fas fa-user "></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="name-student"> <?php echo $_SESSION["current_user_social"]["fullname"]; ?></div>

                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-color  dropdown-menu-right">
                            <a class="dropdown-item" href="https://ciliweb.vn/ciliweb_project/user/account/profile.php"> Profile
                            </a>
                            <a class="dropdown-item" href="https://ciliweb.vn/ciliweb_project/user/account/profile.php"> Đơn mua
                            </a>
                            <a class="dropdown-item" href="https://ciliweb.vn/ciliweb_project/user/account/change_password.php"> Reset Password</a>
                            <a class="dropdown-item" href="#"> Help </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://ciliweb.vn/ciliweb_project/user/account/logout.php"> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="../user/index.php">
                <img src="https://ciliweb.vn/ciliweb_project/user/account/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="75" height="75">
            </a>
            <div class="collapse navbar-collapse">

            </div>

        </nav>

    </div>
<?php
}

?>