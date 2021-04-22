<?php
include "../connect_db.php"
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register Now</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link rel="stylesheet" href="library/fonts/icomoon/style.css">
    <link rel="stylesheet" href="library/css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="library/css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="library/css/style.css">
</head>

<body>

    <body>
        <div class="d-lg-flex half">
            <div class="contents order-1 order-md-2">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <h3><b>Register your account</b></h3>
                            </div>
                            <form class="form" action="" method="post">
                                <h6 style="padding-top: 2% !important;">Fullname</h6>
                                <div class="form-group first" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname">
                                </div>
                                <h6 style="padding-top: 2% !important;">Username</h6>
                                <div class="form-group first" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <h6>Email</h6>
                                <div class="form-group first" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <h6 style="padding-top: 2% !important;">Password</h6>
                                <div class="form-group last mb-3" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">

                                </div>
                                <br>
                                <div class="control-group">
                                    <label>Roles</label>
                                    <select class="form-group" name="role" require>
                                        <option selected value="student">--select role--</option>
                                        <option value="1">Shop-account</option>
                                        <option value="2">User-account</option>
                                    </select>
                                </div>
                                <hr>
                                <div class="alert alert-success" id="success" style="margin-top: 10px; display: none">
                                    <strong>Success!</strong> Account Registration Successfully.
                                </div>
                                <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
                                    <strong>Already exist!</strong> The Username Alreadly Exits!
                                </div>
                                <input type="submit" value="Register" name="register" class="btn btn-block btn-success">

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
        $button = '';
        if (isset($_POST["register"])) {
            $count = 0;
            $result = $link->query("SELECT * from `user` where `username` ='$_POST[username]'");
            $count = mysqli_num_rows($result);

            $encryptPassword = md5("$_POST[password]");


            if ($count > 0) {
        ?>
                <script type="text/javascript">
                    document.getElementById("success").style.display = "none";
                    document.getElementById("failure").style.display = "block";
                </script>
            <?php
            } else {
                $addAccount = $link->query("INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `fullname`, `user_status`, `user_role_id`, `user_create_time`) VALUES (NULL, '$_POST[username]', '$encryptPassword', '$_POST[email]', '$_POST[fullname]', '1', '$_POST[role]', '" . time() . "');");

            ?>
                <script type="text/javascript">
                    const a = document.getElementById("success")
                    document.getElementById("success").style.display = "block";
                    document.getElementById("failure").style.display = "none";
                    if (a.style.display == "block") {
                        setTimeout(function() {
                            window.location.href = "./login.php";
                        }, 500);

                    }
                </script>
        <?php
            }
        }
        ?>



    </body>

</html>