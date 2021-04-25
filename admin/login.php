<?php
session_start();
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

                <div class="container-fluid">

                    <?php
                    include "../connect_db.php"
                    ?>
                    <div class="row ">
                        <div class="col-lg-6 d-none d-md-block bg-cover" style="background-image: url('../images/ciliweb.png');">

                        </div>
                        <div class="col-lg-6  bg-white">
                            <div class="row align-items-center m-h-100">
                                <div class="mx-auto col-md-8">
                                    <div class="p-b-20 m-t-20 text-center">
                                        <h3 class="admin-brand-content">
                                            Login with for admin!
                                        </h3>
                                    </div>
                                    <form action="" name="addUser" id="addU" method="POST" enctype="multipart/form-data">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label for="usernameUserLogin">Email</label>
                                                <input type="text" class="form-control" id="usernameUserLogin" name="usernameUserLogin" placeholder="Enter email..." required>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <label for="passwordUserLogin">Password</label>
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" class="form-control" placeholder="Enter password" name="passwordUserLogin" id="passwordUserLogin" required>
                                                            <label class="custom-input-label" for="inputFile">
                                                                <div class="input-group-addon">
                                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
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
                                            <strong>Login false!</strong><br> The email or passwrord error!
                                        </div>
                                        <hr>
                                        <button type="submit" name="loginAccount" class="btn btn-success btn-block btn-lg">Login</button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
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
                        email: true,
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
                        email: "Please enter and email!",


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
    $username = mysqli_real_escape_string($link, $_POST["usernameUserLogin"]);
    $password = mysqli_real_escape_string($link, $_POST["passwordUserLogin"]);
    $encriptPassword = md5($password);
    $count = 0;

    $res = mysqli_query($link, "select * from admin where username='$username' && password= '$encriptPassword'");
    $count = mysqli_num_rows($res);
    if ($count == 0) {
?>
        <script type="text/javascript">
            document.getElementById("loginFailure").style.display = "block";
        </script>
    <?php
    } else {
        $user = mysqli_fetch_assoc($res);

        $currentUser = $_SESSION["current_user"] =  $user;

    ?>
        <script type="text/javascript">
            document.getElementById("loginSuccess").style.display = "block";
            window.location = "../admin/index.php";
        </script>
<?php
    }
}
?>