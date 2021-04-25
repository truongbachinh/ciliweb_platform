<?php
// include "../config_user.php";
if (isset($userId)) {
    $resultUserInfor = $link->query("SELECT user.password from user where `user_id` = '$userId'");
} else {
    $resultUserInfor = $link->query("SELECT `password` from admin where `admin_id` = '$adminId'");
}

$userInfor = mysqli_fetch_assoc($resultUserInfor);


?>

<section class="admin-content " style="margin-top: 100px;">
    <div class="container m-t-30">
        <div class="card m-b-30">
            <div class="card-header">
                <h5 class="m-b-0">
                    Change Password
                </h5>
                <p class="m-b-0 text-muted">
                    Please input fullfill box to change your password.
                </p>
            </div>
            <div class="card-body ">
                <form action="" id="changePass" name="formPassword" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="oldPassword">Old Password</label>
                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter old password." required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password." required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Comfirm new password." required>
                    </div>
                    <div class="alert alert-success" id="success" style="margin-top: 10px; display: none">
                        <strong>Success!</strong> Change password success!
                    </div>
                    <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
                        <strong>Error!</strong> The Old password wrong!
                    </div>
                    <div class="alert alert-danger" id="checkpass" style="margin-top: 10px; display: none">
                        <strong>Error!</strong> The new password not cofirm to old password!
                    </div>

                    <div class="text-center">
                        <button type="submit" name="changePassword" class="btn btn-primary float-right">Change
                            password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#changePass").validate({
            rules: {
                oldPassword: {
                    required: true,
                    minlength: 6,
                },
                newPassword: {
                    required: true,
                    minlength: 6,
                    maxlength: 36,
                },
                confirmPassword: {
                    required: true,
                    equalTo: "#newPassword",
                    maxlength: 36,
                }

            },
            messages: {
                oldPassword: {
                    required: "Information required! Please enter full information..",
                    minLength: "Password consists of at least 6 characters!",
                },
                newPassword: {
                    required: "Information required! Please enter full information..",
                    minLength: "Password consists of at least 6 characters!",
                    maxLength: "Password consists of at most 36 characters",
                },
                confirmPassword: {
                    required: "Information required! Please enter full information..",
                    minLength: "Password consists of at least 6 characters",
                    maxLength: "Password consists of at most 36 characters",
                    equalTo: "Wrong confirm password!",
                }
            },
        })
    })
</script>


<?php
if (isset($_POST["changePassword"])) {
    $pOldPassword = md5($_POST['oldPassword']);
    $pNewPassword = $_POST['newPassword'];
    $pConfirmPassword = $_POST['confirmPassword'];

    $oldPassword = $userInfor['password'];

    // var_dump($pOldPassword);
    // var_dump($oldPassword);
    // exit;

    if ($pOldPassword != $oldPassword) {

?>
        <script type="text/javascript">
            document.getElementById("checkpass").style.display = "none";
            document.getElementById("success").style.display = "none";
            document.getElementById("failure").style.display = "block"
        </script>
    <?php
    } elseif ($pNewPassword != $pConfirmPassword) {

    ?>
        <script type="text/javascript">
            document.getElementById("checkpass").style.display = "block";
            document.getElementById("success").style.display = "none";
            document.getElementById("failure").style.display = "none"
        </script>
        <?php
    } elseif (($pOldPassword == $oldPassword) && ($pNewPassword != $oldPassword)) {
        if (isset($userId)) {
            $update =  mysqli_query($link, "update user set `password` = '" . md5($pNewPassword) . "' where user_id =  '$userId'");
        } else {
            $update =  mysqli_query($link, "update admin set `password` = '" . md5($pNewPassword) . "' where admin_id =  '$adminId'");
        }

        if ($update) {


            if (isset($adminId)) {
        ?>
                <script type="text/javascript">
                    document.getElementById("success").style.display = "block";
                    document.getElementById("failure").style.display = "none";
                    document.getElementById("checkpass").style.display = "none";
                    session_destroy();

                    function backLoginPage() {
                        window.location = "../admin/login.php";
                    }
                    setTimeout(backLoginPage, 1000);
                </script>
            <?php
            }
            ?>
            <script type="text/javascript">
                document.getElementById("success").style.display = "block";
                document.getElementById("failure").style.display = "none";
                document.getElementById("checkpass").style.display = "none";
                session_destroy();

                function backLoginPage() {
                    window.location = "../account/login.php";
                }
                setTimeout(backLoginPage, 1000);
            </script>
<?php
        }
    }
}
?>