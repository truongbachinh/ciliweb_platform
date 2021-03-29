<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login For User</title>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="./library/fonts/icomoon/style.css">

    <link rel="stylesheet" href="./library/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./library/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="./library/css/style.css">

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <?php
    session_start();
    if (!empty($_SESSION['current_user_social'])) {
        $currentUser = $_SESSION['current_user_social'];

    ?>
        <script type="text/javascript">
            window.location = "../user/index.php";
        </script>
    <?php
    } else {
        include "../connect_db.php";
        include "login_facebook/fb_connect.php";
        include "login_google/goole_connect.php";

    ?>
        <div class="d-lg-flex half">
            <div class="contents order-1 order-md-2">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <h6>Welcome back!</h6>
                                <h3><b>Sign in to your account</b></h3>
                            </div>
                            <form class="form-vertical" action="" method="post">
                                <h6>Username or Email</h6>
                                <div class="form-group first" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                    <label class="lableSign" for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <h6 style="padding-top: 1% !important;">Password</h6>
                                <div class="form-group last mb-3" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                    <label class="lableSign" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">

                                </div>

                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                        <input type="checkbox" checked="checked" />
                                        <div class="control__indicator" style="border-radius: 11px !important;"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password?</a></span>
                                </div>
                                <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
                                    <strong>Login false!</strong><br> The Username or passwrord error!
                                </div>
                                <input type="submit" value="Login" name="login" class="btn btn-block btn-success">
                                <div class="break-heading">
                                    or
                                </div>
                                <?php
                                // đăng nhập bằng $loginUrl khi nó đã tồn tại
                                if (isset($authUrl)) {
                                ?>
                                    <div class="social-login" style="margin-top: 3%;">
                                        <a href="<?= $authUrl ?>" class="btn btn-primary d-flex justify-content-center align-items-center">
                                            Sign-in with <span class="fa fa-google ml-2"></span>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="social-login" style="margin-top: 3%;">
                                    <a href="<?= $loginUrl ?>" class="btn btn-info d-flex justify-content-center align-items-center">
                                        Sign-in with <span class="fa fa-facebook ml-2"></span>
                                    </a>
                                </div>
                                <div class="social-login" style="margin-top: 10%;">
                                    <span class="d-flex justify-content-center align-items-center">Dont have a account? <a href="register.php" class="ml-2 mt-2" style="color: #00bfff"> Sign Up</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg order-2 order-md-1" style="background-image: url('images/ciliweb.png');"></div>
        </div>


        <script src="library/js/jquery-3.3.1.min.js"></script>
        <script src="library/js/popper.min.js"></script>
        <script src="library/js/bootstrap.min.js"></script>
        <script src="library/js/main.js"></script>
    <?php
    }
    ?>
</body>

</html>

<?php
if (isset($_POST["login"])) {

    $username = mysqli_real_escape_string($link, $_POST["username"]);
    $password = mysqli_real_escape_string($link, $_POST["password"]);

    $count = 0;
    $res = mysqli_query($link, "select * from user where username='$username' && password='$password'");
    $result = mysqli_query($link, "select * from user where username='$username' && password='$password'");

    $count = mysqli_num_rows($res);
    while ($row = mysqli_fetch_array($result)) {

        $role = $row["user_role_id"];
        $status = $row["user_status"];
    }
    var_dump($role);
    var_dump($status);
    // exit;

    if ($count == 0) {
?>
        <script type="text/javascript">
            document.getElementById("failure").style.display = "block";
        </script>
    <?php
    } elseif ($role == "1" &&  $status = "1") {
        $user = mysqli_fetch_assoc($res);
        $userCurrent =  $_SESSION["current_user"] = $user;
    ?>
        <script type="text/javascript">
            window.location = "../shop/index.php";
        </script>
    <?php
    } elseif ($role == "2" &&  $status = "1") {
        $user = mysqli_fetch_assoc($res);
        $userCurrent =  $_SESSION["current_user"] = $user;

    ?>
        <script type="text/javascript">
            window.location = "../user/index.php";
        </script>
<?php

    }
}
?>
<?php
include "footer.php";
?>