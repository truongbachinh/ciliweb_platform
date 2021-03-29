<!-- Main Navigation -->
<?php
include "../connect_db.php";

if (!empty($_SESSION["current_user"])) {


    // $cartUId = $_SESSION["current_user"]['user_id'];
    // $results = $link->query("SELECT COUNT(cart_id) FROM cart WHERE cart_user_id = ' $cartUId'");
    // $countProduct = mysqli_fetch_array($results);
?>
    <div class="header-content">
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="/ciliweb_platform/user/index.php" id="logo-brand">
                <i class="fas fa-home"></i> Seller channel
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ciliweb-navBar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="ciliweb-navBar">
                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item active">
                        <form action="" method="post">
                            <div style="margin-right: 15px; ">
                                <button type="submit" class="btn btn-outline-danger" name="cartBT"> <span id="cartCountHeader"> <?php include_once "cartCount.php"; ?> </span></button>
                            </div>
                        </form>

                    </li>
                </ul>
                <?php
                if (isset($_POST["cartBT"])) {
                    header("location: ../user/cart/cart.php");
                }
                ?>

                <ul class="navbar-nav ">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="../account/profile.php" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="d-inline-flex">
                                <div class="avatar avatar-sm avatar-online mr-3">
                                    <span class="avatar-title rounded-circle"><i class="fas fa-user "></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="name-student"> <?php echo $_SESSION["current_user"]["username"]; ?></div>

                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-color  dropdown-menu-right">
                            <a class="dropdown-item" href="../account/profile.php"> Profile
                            </a>
                            <a class="dropdown-item" href="../account/profile.php"> Đơn mua
                            </a>
                            <a class="dropdown-item" href="../account/change_password.php"> Reset Password</a>
                            <a class="dropdown-item" href="#"> Help </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../account/logout.php"> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="https://ciliweb.vn/ciliweb_project/shop/register_shop.php">
                <img src="https://ciliweb.vn/ciliweb_project/user/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="75" height="75">
            </a>
            <div class="collapse navbar-collapse">
            </div>
        </nav>


        <section class="search-bar search-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-5 col-6 mx-auto ">
                        <form action="">
                            <div class="input">
                                <div class="input-group">
                                    <input type="search" class="form-control empty d-flex justify-content-center" id="searchNameFood" value="<?php if (isset($_POST['searchText'])) echo $_POST['searchText'] ?>" placeholder="Search seafood..." />

                                    <!-- <span class="input-group-text border-0" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </span> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php
} elseif (!empty($_SESSION["current_user_social"])) {
    // $cartUId = $_SESSION["current_user_social"]['user_id'];
    // $countProduct = $link->query("SELECT COUNT(cart_id) FROM cart WHERE cart_user_id = ' $cartUId'");

?>
    <div>
        <nav class=" navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="/ciliweb_project/account/login.php" id="logo-brand">
                <i class="fas fa-home"></i> Seller channel
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ciliweb-navBar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="ciliweb-navBar">
                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item active">
                        <form action="" method="post">
                            <div style="margin-right: 15px; ">
                                <button type="submit" class="btn btn-outline-danger" name="cartBT"> <span> <i class="fas fa-shopping-cart" style="color:floralwhite"><?= $GLOBALS['countProduct'][0] ?>s</i></span></button>
                            </div>
                        </form>

                    </li>
                </ul>
                <?php
                if (isset($_POST["cartBT"])) {
                    header("location: ../user/cart/cart.php");
                }
                ?>
                <ul class="navbar-nav ">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="../account/profile.php" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <a class="dropdown-item" href="../account/profile.php"> Profile
                            </a>
                            <a class="dropdown-item" href="../account/profile.php"> Đơn mua
                            </a>
                            <a class="dropdown-item" href="../change_password.php"> Reset Password</a>
                            <a class="dropdown-item" href="#"> Help </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../account/logout.php"> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="../user/index.php">
                <img src="https://ciliweb.vn/ciliweb_project/user/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="75" height="75">
            </a>
            <div class="collapse navbar-collapse">

            </div>

        </nav>
        <section class="search-bar search-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-5 col-6 mx-auto ">
                        <form action="">
                            <div class="input">
                                <div class="input-group">
                                    <input type="search" class="form-control empty d-flex justify-content-center" id="searchNameFood" value="<?php if (isset($_POST['searchText'])) echo $_POST['searchText'] ?>" placeholder="Search seafood..." />
                                    <span class="input-group-text border-0" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
} else {

?>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="../user/index.php" id="logo-brand">
                <i class="fas fa-home"></i> Seller channel
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ciliweb-navBar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="ciliweb-navBar">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item active">

                    </li>
                </ul>
                <ul class="navbar-nav ml-auto ">
                    &nbsp;
                    <li class="nav-item">
                        <a class="nav-link " id="login" href="../account/login.php"><i class="fas fa-sign-in-alt"></i>Log in</a>
                    </li>
                    <div class="verticalLine">

                    </div>
                    <li class="nav-item">
                        <a class="nav-link " id="sign-up" href="../account/register.php"><i class="fas fa-user-plus"></i>Sign up</a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="../user/index.php">
                <img src="https://ciliweb.vn/ciliweb_project/user/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="75" height="75">
            </a>
            <div class="collapse navbar-collapse">

            </div>

        </nav>
        <section class="search-bar search-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-5 col-6 mx-auto ">
                        <form action="">
                            <div class="input">
                                <div class="input-group">
                                    <input type="search" class="form-control empty d-flex justify-content-center" id="searchNameFood" value="<?php if (isset($_POST['searchText'])) echo $_POST['searchText'] ?>" placeholder="Search seafood..." />
                                    <span class="input-group-text border-0" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>



    </div>

<?php
}
?>