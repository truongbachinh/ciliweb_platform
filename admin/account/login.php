<?php
session_start();
include "../../connect_db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login For User</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- font-cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <!-- bootstrap 4 cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jquery 4 cdn -->

</head>
<div class="header">
    <a href="index_admin.php" style="color:white"><i class="icon icon-share-alt"></i><span>Login For Admin</span></a>
</div>

<body>
    <div id="loginbox">
        <form name="forml" class="form-vertical" action="" method="post">
            <div class="control-group normal_text">
                <h3>Login Page</h3>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Username" name="username" require />
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password" require />
                    </div>
                </div>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Remember Me
                </label>
            </div>
            <div class="form-actions">
                <span class="pull-left"><input type="submit" name="login" value="Login" class="btn btn-success"></span>
                <span class="pull-right"><a href="register.php" class="flip-link btn btn-info" id="to-recover">Register?</a></span>
            </div>
        </form>

        <?php
        if (isset($_POST["login"])) {
            $username = mysqli_real_escape_string($link, $_POST["username"]);
            $password = mysqli_real_escape_string($link, $_POST["password"]);

            $count = 0;
            $res = mysqli_query($link, "select * from admin where username='$username' && password='$password'");
            $count = mysqli_num_rows($res);
            if ($count == 0) {
        ?>
                <script type="text/javascript">
                    document.getElementById("failure").style.display = "block";
                </script>
            <?php
            } else {
                $user = mysqli_fetch_assoc($res);
                $currentUser = $_SESSION["current_user"] =  $user;

            ?>
                <script type="text/javascript">
                    window.location = "../index.php";
                </script>
        <?php
            }
        }
        ?>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>