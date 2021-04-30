<?php
include "../connect_db.php";
include "../mailer/class.phpmailer.php";
include "../mail_process.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>

    </link>
</head>

<body class="sidebar-pinned " style="overflow-x: hidden;">

    <main class="user-main">

        <!-- PLACE CODE INSIDE THIS AREA -->

        <div class="container-fluid">


            <?php
            include "../connect_db.php"
            ?>


            <div class="row ">
                <div class="col-lg-5  bg-white">
                    <div class="row align-items-center m-h-100">
                        <div class="mx-auto col-md-8">
                            <div class="p-b-20 text-center">
                                <h3 class="admin-brand-content">
                                    Forgot password!
                                </h3>
                                <p class="m-b-0 text-muted">
                                    Please enter your email and username to search for your account. If email and username are correct. Password will be sent to your email.
                                </p>
                            </div>
                            <form action="" name="forgotPass" id="forgotPass" method="POST" enctype="multipart/form-data">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="usernameUser" placeholder="Enter username..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1">Email</label>
                                        <input type="email" class="form-control" id="inputEmail1" placeholder="Enter email" name="emailUser" required>
                                    </div>
                                </div>
                                <div class="alert alert-success" id="forgotSuccess" style="margin-top: 10px; display: none">
                                    <strong>Success!</strong> Register account success!
                                </div>
                                <div class="alert alert-danger" id="checkUsername" style="margin-top: 10px; display: none">
                                    <strong>Error!</strong> Username wrong, Please try again!
                                </div>
                                <div class="alert alert-danger" id="checkMail" style="margin-top: 10px; display: none">
                                    <strong>Error!</strong> Email wrong, Please try again!
                                </div>
                                <div class="alert alert-danger" id="checkMailAndUser" style="margin-top: 10px; display: none">
                                    <strong>Error!</strong> Email and username invalid, Please try again!
                                </div>

                                <button type="submit" name="forgotButton" class="btn btn-info btn-block btn-lg">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-md-block bg-cover" style="background-image: url('./images/ciliweb.png');">
                </div>
            </div>

        </div>
    </main>
</body>









<!--/ PLACE CODE INSIDE THIS AREA -->

<?php include "../partials/js_libs.php"; ?>


<script>
    $(document).ready(function() {

        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "Value must not equal arg.");

        $.validator.addMethod("lettersOnly", function(value, element) {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        }, "Letters and spaces only please");
        $('#forgotPass').validate({
            rules: {

                usernameUser: {
                    required: true,
                    minlength: 6,
                    maxlength: 32,


                },
                emailUser: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                usernameUser: {
                    required: "Please provide information!",
                    minlength: "Please provide at least 6 characters.",
                    maxlength: "Please provide at must 32 characters.",

                },
                emailUser: {
                    required: "Please provide information!",
                    email: "Please provide an email.",
                },
            },
        })
    })
</script>
</body>

</html>






<?php

if (isset($_POST["forgotButton"])) {



    $result = $link->query("SELECT user.email , user.password FROM `user` where `username` = '$_POST[usernameUser]' AND `email`='$_POST[emailUser]'");
    $checkAccount = $result->fetch_assoc();
    if (empty($checkAccount)) {
?>
        <script type="text/javascript">
            document.getElementById("checkMailAndUser").style.display = "block";
            document.getElementById("forgotSuccess").style.display = "none"
        </script>
    <?php
    } else {


        $email =   $_POST['emailUser'];
        $message = 'You password is: ' .  $checkAccount['password'] .
            '' .
            ' Please go to https://www.md5decrypt.org/ and decrypt the password here. Your passwords are encrypted to make sure your account is untouchable';
        $subject = "Notification from Cili website";
        $text_message    =   "hello";
        send_mail($email, $subject, $message, $text_message);

    ?>
        <script type="text/javascript">
            const a = document.getElementById("forgotSuccess");
            document.getElementById("checkMailAndUser").style.display = "none";
            document.getElementById("forgotSuccess").style.display = "block";
            document.getElementById("checkUsername").style.display = "none";
            document.getElementById("checkMail").style.display = "none";
            if (a.style.display == "block") {
                swal("Notice", "Password has been sent. Please check your email!", "success");
                setTimeout(function() {
                    window.location.href = "../account/login.php";
                }, 2000);
            }
        </script>
<?php
    }
}
?>