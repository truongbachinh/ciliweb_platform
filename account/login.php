<?php
session_start();
include "../connect_db.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../account/css/login.css">
    <style>
        a,
        a:hover {
            color: #333
        }
    </style>
</head>

<body class="sidebar-pinned " style="overflow-x: hidden;">

    <main class="user-main">

        <!-- PLACE CODE INSIDE THIS AREA -->

        <body>
            <main class="user-main">
                <!-- PLACE CODE INSIDE THIS AREA -->

                <?php
                if (!empty($_SESSION['current_user'])) {
                    $userCurrent =  $_SESSION["current_user"];
                ?>
                    <script type="text/javascript">
                        window.location = "../user/index.php";
                    </script>
                <?php
                } else {



                    include('../login_facebook/fb_connect.php');
                    include('../login_google/goole_connect.php');
                ?>
                    <div class="container-fluid">

                        <div class="row ">
                            <div class="col-lg-6 d-none d-md-block bg-cover" style="background-image: url('./images/ciliweb.png');">

                            </div>
                            <div class="col-lg-6  bg-white">
                                <div class="row align-items-center m-h-100">
                                    <div class="mx-auto col-md-8">
                                        <div class="p-b-20 m-t-20 text-center">
                                            <h3 class="admin-brand-content">
                                                Login with account!
                                            </h3>
                                        </div>
                                        <form action="" name="addUser" id="addU" method="POST" enctype="multipart/form-data">
                                            <div class="form-col">
                                                <div class="form-group">
                                                    <label for="usernameUserLogin">Username</label>
                                                    <input type="text" class="form-control" id="usernameUserLogin" name="usernameUserLogin" placeholder="Enter username..." required>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <label for="passwordUserLogin">Password</label>
                                                            <div class="input-group" style="flex-flow: row-reverse;" id="show_hide_password">
                                                                <input type="password" class="form-control" placeholder="Enter password" name="passwordUserLogin" id="passwordUserLogin" required>
                                                                <label class=" custom-input-label" style="position: absolute;" for="inputFile">
                                                                    <div class="input-group-addon">
                                                                        <a href=""><i class="fa fa-eye-slash" style=" font-size: 18px; " aria-hidden="true"></i></a>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <label for="passwordUserLogin" class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                                        <input type="checkbox" checked="checked" />
                                                        <div class="control__indicator" style="border-radius: 11px !important;"></div>
                                                    </label>
                                                    <span class="ml-auto"><a href="../account/forgot_password.php" class="forgot-pass">Forgot Password?</a></span>
                                                </div>
                                            </div>
                                            <div class="alert alert-success" id="loginSuccess" style="margin-top: 10px; display: none">
                                                <strong>Success!</strong> Login successfully!
                                            </div>
                                            <div class="alert alert-danger" id="loginFailure" style="margin-top: 10px; display: none">
                                                <strong>Login false!</strong><br> The Username or passwrord error!
                                            </div>
                                            <hr>
                                            <button type="submit" name="loginAccount" class="btn btn-success btn-block btn-lg">Login</button>
                                            <div class="break-heading">
                                                or
                                            </div>

                                            <!-- login with facebook -->
                                            <div class="social-login" style="margin-top: 3%;">
                                                <a href="<?= $loginUrl ?>" class="btn btn-info d-flex justify-content-center align-items-center">
                                                    Sign-in with <span class="fa fa-facebook ml-2"></span>
                                                </a>
                                            </div>
                                            <!-- login with goole -->
                                            <?php
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
                                            <div class="social-login" style="margin-top: 10%;">
                                                <span class="d-flex justify-content-center align-items-center">Dont have a account? <a href="../account/register.php" class="ml-2 " style="color: #00bfff"> Sign Up</a></span>
                                            </div>
                                        </form>
                                        <hr>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                <?php
                }
                ?>
            </main>
        </body>
        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>


    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });
        $(document).ready(function() {


            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-z," "]+$/i.test(value);
            }, "Letters and spaces only please");
            $('#addU').validate({
                rules: {
                    usernameUserLogin: {
                        required: true,
                        minlength: 5,
                        maxlength: 32,
                    },
                    passwordUserLogin: {
                        required: true,
                        minlength: 6,
                        maxlength: 32,
                    },
                },
                messages: {
                    usernameUserLogin: {
                        required: "Please provide information!",
                        minlength: "Please provide at least 6 characters.",
                        maxlength: "Please provide at must 32 characters.",


                    },
                    passwordUserLogin: {
                        required: "Please provide information!",
                        minlength: "Please provide at least 6 characters.",
                        maxlength: "Please provide at must 32 characters.",
                    },
                },
            })
        })
    </script>
</body>

</html>





<?php
if (isset($_POST["loginAccount"])) {
    $sessionStatus = "Active now";
    $username =  $_POST["usernameUserLogin"];
    $password =  md5($_POST["passwordUserLogin"]);

    $count = 0;
    $res = mysqli_query($link, "SELECT user.* from user where username='$username' AND `password`='$password'");
    $result = mysqli_query($link, "SELECT * from user where username='$username' AND `password`='$password'");

    $updateSessionStatus = $link->query("UPDATE `user` SET `session_status` = '$sessionStatus'  where username='$username' AND `password`='$password'");

    $count = mysqli_num_rows($res);
    while ($row = mysqli_fetch_array($result)) {

        $role = $row["user_role_id"];
        $status = $row["user_status"];
    }


    if ($count == 0) {
?>
        <script type="text/javascript">
            document.getElementById("loginFailure").style.display = "block";
            document.getElementById("loginSuccess").style.display = "none";
        </script>
    <?php
    } elseif ($role == "1" &&  $status = "1") {
        $user = mysqli_fetch_assoc($res);
        $userCurrent =  $_SESSION["current_user"] = $user;
    ?>
        <script type="text/javascript">
            const checklog = document.getElementById("loginSuccess")
            document.getElementById("loginSuccess").style.display = "block";
            document.getElementById("loginFailure").style.display = "none";
            if (checklog.style.display == "block") {
                setTimeout(function() {
                    window.location = "../shop/index.php";
                }, 1000);
            }
        </script>
    <?php
    } elseif ($role == "2" &&  $status = "1") {
        $user = mysqli_fetch_assoc($res);
        $userCurrent =  $_SESSION["current_user"] = $user;

    ?>
        <script type="text/javascript">
            const checklog = document.getElementById("loginSuccess")
            document.getElementById("loginSuccess").style.display = "block";
            document.getElementById("loginFailure").style.display = "none";
            if (checklog.style.display == "block") {
                setTimeout(function() {
                    window.location = "../user/index.php";
                }, 1000);
            }
        </script>
<?php

    }
}
?>
<?php
include "footer.php";
?>