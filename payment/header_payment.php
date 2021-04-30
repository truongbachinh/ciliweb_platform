<!-- Main Navigation -->

<link rel="stylesheet" href="../payment/css/header_payment.css">
<?php
// include "../config_user.php";

if (!empty($_SESSION["current_user"])) {

    $userId = $_SESSION["current_user"]['user_id'];
}


// if (!empty($resultUserInfor)) {
$resultUserInfor = mysqli_query($link, "SELECT  user.*, user_infor.*  from user_infor INNER JOIN user ON user.user_id = user_infor.ui_user_id WHERE `user_id` = '$userId'");
// }
// if (!empty($resultUserInfor)) {
$rowUser = mysqli_fetch_assoc($resultUserInfor);
// }

if (!empty($_SESSION["current_user"])) {
?>
    <div class="header-content">
        <nav class="navbar navbar-expand-lg bg-nav">
            <ul class="navbar-nav  ">
                <nav class="navbar navbar-expand-lg bg-nav">
                    <a class="navbar-brand" href="../user/index.php">
                        <img src="https://ciliweb.vn/ciliweb_project/user/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="55" height="55">
                    </a>
                </nav>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ciliweb-navBar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="ciliweb-navBar">

                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item dropdown ">
                        <div>
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
                        </div>
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
    </div>
<?php
} else {
?>
    <script>
        window.location.replace("../account/login.php");
    </script>
<?php

}

?>