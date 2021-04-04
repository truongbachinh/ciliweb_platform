<?php
ob_start();
?>


<link rel="stylesheet" href="../partials/css/header_user.css">
<header class="user-header">
    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
    <nav class=" ml-auto">
        <ul class="nav align-items-center m-r-30">
            <li class=nav-item>
                <div class="d-flex p-all-15  justify-content-between">
                    <a href="#!" class="nar-link"><i class="mdi mdi-24px mdi-chat"></i>
                        <!-- <span class="notification-counter"></span></a> -->
            </li>
            <?php if (!empty($_SESSION["current_user"]["username"])) : ?>
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
                                            <button type="submit" class="btn btn-outline-danger" name="cartBT"> <span id="cartCountHeader"><?php include "../partials/cart_count.php" ?></span></i>
                                                </span></button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                            <?php
                            if (isset($_POST["cartBT"])) {

                                header("location: ../cart/cart.php");
                            }
                            ?>
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
                                        <a href="../user/index.php?view=profile" class="dropdown-item"> Profile</a>
                                        <a href="../user/index.php?view=myorder" class="dropdown-item"> My Order</a>
                                        <a href="../account/change_password.php" class="dropdown-item"> Reset Password</a>
                                        <a class="dropdown-item" href=""> Help </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="../account/logout.php" class="dropdown-item"> Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                        <a class="navbar-brand" href="../account/login.php">
                            <img src="https://ciliweb.vn/ciliweb_project/user/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="55" height="55">
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



                <div class="nav-item m-r-3">
                    <a href="#">
                        <b><?= $_SESSION['current_user']['username'] ?></b>
                    </a>
                </div>
            <?php elseif (!empty($_SESSION["current_user"]["fullname"])) : ?>
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
                                            <button type="submit" class="btn btn-outline-danger " id="cartBT"> <span id="cartCountHeader"> <?php include_once "../user/cartCount.php"; ?> </span></button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                            <!-- <?php
                                    if (isset($_POST["cartBT"])) {
                                        header("location: ../cart/cart.php");
                                    }
                                    ?> -->
                            <ul class="navbar-nav ">
                                <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="avatar avatar-sm avatar-online">
                                            <?php
                                            if ($resultUserInfor->num_rows > 0) {
                                                $imageURL = '../user/avatar_user' . $rowUser["ui_avatar"];
                                            ?>
                                                <img class="avatar-img rounded-circle" src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                            <?php
                                            } else { ?>
                                                <span class="avatar-title rounded-circle bg-warning"><?php echo $_SESSION["current_user"]["fullname"]; ?></span>

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
                    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                        <a class="navbar-brand" href="https://ciliweb.vn/ciliweb_project/shop/register_shop.php">
                            <img src="https://ciliweb.vn/ciliweb_project/user/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="55" height="55">
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
<script type="text/javascript">
    // $("#cartBT").submit(function(event) {
    //     event.preventDefault();
    //     console.log("data", $(this).serializeArray());

    //     $.ajax({
    //         type: "POST",
    //         url: '../cart_count.php',
    //         data: $(this).serializeArray(),
    //         success: function(response) {
    //             response = JSON.parse(response);
    //             if (response.status == 0) {

    //             } else {
    //                 // alert(response.message);
    //                 // $.get('../cart_count.php', function(cartCountHTML) {
    //                 //     console.log("cart-count", cartCountHTML);
    //                 //     $('#cartCountHeader').html(cartCountHTML);
    //                 // })
    //                 <?php
                        //                 var_dump($_POST["cartBT"]);
                        //                 exit;
                        //                 header("location: ./cart/cart.php");
                        //                 
                        ?>
    //             }
    //         }

    //     })


    // })
</script>