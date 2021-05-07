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
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="../user/index.php" id="logo-brand">
                <i class="fas fa-home"></i> Index page
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

                            <?php
                            if ($resultUserInfor->num_rows > 0) {
                                $imageURL = '../user/avatar/' . $rowUser["ui_avatar"];
                            ?>
                                <div class="avatar avatar-sm avatar-online">
                                    <img class="avatar-img rounded-circle" src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                </div>
                            <?php
                            } else { ?>
                                <div class="btn btn-outline-warning">
                                    <span style="color:aliceblue"><?php if (!empty($_SESSION["current_user"]["username"])) {
                                                                        echo $_SESSION["current_user"]["username"];
                                                                    } else {
                                                                        echo $_SESSION["current_user"]["fullname"];
                                                                    } ?></span>
                                </div>
                            <?php } ?>



                        </a>
                        <div class="dropdown-menu  dropdown-menu-right">
                            <a href="../user/index.php?view=profile" class="dropdown-item"> Profile</a>
                            <a href="../user/index.php?view=conversation" class="dropdown-item"> My conversation</a>
                            <a href="../user/index.php?view=myorder" class="dropdown-item"> My Order</a>
                            <a href="../user/index.php?view=changepass" class="dropdown-item"> Reset Password</a>

                            <div class="dropdown-divider"></div>
                            <a href="../account/logout.php" class="dropdown-item"> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>


    </div>



    <div class="nav-item m-r-3">
        <a href="#">
            <b><?= $_SESSION['current_user']['username'] ?></b>
        </a>
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