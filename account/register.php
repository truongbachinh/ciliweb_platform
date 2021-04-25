<?php
include "../config_user.php";


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
                                    Register account!
                                </h3>
                            </div>
                            <form action="" name="addUser" id="addU" method="POST" enctype="multipart/form-data">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label for="inputName1">Full name</label>
                                        <input type="text" class="form-control" id="inputName1" name="fullnameUser" placeholder="Enter fullname" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="usernameUser" placeholder="Enter username..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1">Email</label>
                                        <input type="email" class="form-control" id="inputEmail1" placeholder="Enter email" name="emailUser" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPass1">Password</label>
                                        <input type="password" class="form-control" placeholder="Enter password" name="passwordUser" id="inputPass1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPass2">Confirm Passs</label>
                                        <input type="password" class="form-control" id="inputPass2" placeholder="Enter confirm password" name="confirmpasswordUser" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-role">Role</label>
                                        <select name="selectRole" id="inp-role" class="form-control">
                                            <option value="default">Select Role</option>
                                            <option value="1">Provider-account</option>
                                            <option value="2">Customer-account</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="alert alert-success" id="registerSuccess" style="margin-top: 10px; display: none">
                                    <strong>Success!</strong> Register account success!
                                </div>
                                <div class="alert alert-danger" id="checkUsername" style="margin-top: 10px; display: none">
                                    <strong>Error!</strong> Username already exists, Please, enter another username!
                                </div>
                                <div class="alert alert-danger" id="checkMail" style="margin-top: 10px; display: none">
                                    <strong>Error!</strong> Email already exists, Please, enter another email!
                                </div>

                                <button type="submit" name="registerAccount" class="btn btn-primary btn-block btn-lg">Register</button>
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
        $('#addU').validate({
            rules: {
                fullnameUser: {
                    required: true,
                    lettersOnly: true,
                },
                usernameUser: {
                    required: true,
                    minlength: 6,
                    maxlength: 32,


                },
                passwordUser: {
                    required: true,
                    minlength: 6,
                    maxlength: 32,
                },
                confirmpasswordUser: {
                    required: true,
                    equalTo: '#inputPass1',

                },
                emailUser: {
                    required: true,
                    email: true,
                },
                selectRole: {
                    valueNotEquals: "default"
                }

            },
            messages: {
                fullnameUser: {
                    required: "Please provide information!",
                    lettersOnly: "Please provide only character in alphabet!",
                },
                usernameUser: {
                    required: "Please provide information!",
                    minlength: "Please provide at least 6 characters.",
                    maxlength: "Please provide at must 32 characters.",

                },
                passwordUser: {
                    required: "Please provide information!",
                    minlength: "Please provide at least 6 characters.",
                    maxlength: "Please provide at must 32 characters.",
                },
                confirmpasswordUser: {
                    required: "Please provide information!",
                    equalTo: 'Not match with password',
                },
                emailUser: {
                    required: "Please provide information!",
                    email: "Please provide an email.",
                },
                selectRole: {
                    valueNotEquals: "Please select an role!"
                }
            },
        })
    })
</script>
</body>

</html>






<?php

if (isset($_POST["registerAccount"])) {
    $encryptPassword = md5("$_POST[confirmpasswordUser]");
    $result = $link->query("SELECT * from `user` where `username` = '$_POST[usernameUser]' or `email`='$_POST[emailUser]'");
    $checkAccount = $result->fetch_assoc();
    if (!empty($checkAccount) && $checkAccount['username'] == $_POST['usernameUser']) {
?>
        <script type="text/javascript">
            document.getElementById("checkUsername").style.display = "block";
            document.getElementById("checkMail").style.display = "none";
            document.getElementById("registerSuccess").style.display = "none"
        </script>
    <?php
    } elseif (!empty($checkAccount) && $checkAccount['email'] == $_POST['emailUser']) {

    ?>
        <script type="text/javascript">
            document.getElementById("checkUsername").style.display = "none";
            document.getElementById("checkMail").style.display = "block";
            document.getElementById("registerSuccess").style.display = "none"
        </script>
    <?php

    } else {

        $addAccount = $link->query("INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `fullname`, `user_status`, `user_role_id`, `user_create_time`) VALUES (NULL, '$_POST[usernameUser]', '$encryptPassword', '$_POST[emailUser]', '$_POST[fullnameUser]', '1', '$_POST[selectRole]', '" . $timeInVietNam . "');");

    ?>
        <script type="text/javascript">
            const a = document.getElementById("registerSuccess")
            document.getElementById("registerSuccess").style.display = "block";
            document.getElementById("checkUsername").style.display = "none";
            document.getElementById("checkMail").style.display = "none";
            if (a.style.display == "block") {
                setTimeout(function() {
                    window.location.href = "./login.php";
                }, 2000);

            }
        </script>
<?php
    }
}
?>