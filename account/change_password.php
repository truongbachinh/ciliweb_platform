<?php
session_start();
include "../connect_db.php";

?>
<div>
    <form name="forml" class="form-vertical" action="" method="post">
        <div class="control-group normal_text">
            <h3>Change password Page</h3>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Old password" name="oldPassword" require />
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
        <div class="alert alert-success" id="success" style="margin-top: 10px; display: none">
            <strong>Success!</strong> Change password success!
        </div>
        <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
            <strong>Error!</strong> The Old password wrong!
        </div>

        <div class="text-center">
            <button type="submit" name="changePassword" class="btn btn-success">Change password</button>
        </div>
    </form>
</div>
<?php
if (isset($_POST['changePassword'])) {



    $currentPasssword = ($_SESSION["current_user"]['password']);
    $currentId = ($_SESSION["current_user"]['user_id']);

    if (($_POST['oldPassword'] == $currentPasssword) && ($_POST['password'] != $currentPasssword)) {
        mysqli_query($link, "update user set `password` = '$_POST[password]' where user_id =  $currentId");
        unset($_SESSION['current_user']);
?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "block";
            document.getElementById("failure").style.display = "none"

            window.location = "./login.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "none";
            document.getElementById("failure").style.display = "block"
        </script>
<?php
    }
}

?>