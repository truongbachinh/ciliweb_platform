<?php
session_start();
include "../connect_db.php";
$sessionStatus = "Offline now";
$id = $_SESSION['current_user']['user_id'];
$updateSessionStatus = $link->query("UPDATE `user` SET `session_status` = '$sessionStatus'  where `user_id` = '$id '");
unset($_SESSION['access_token']);
unset($_SESSION['current_user_social']);
unset($_SESSION['current_user']);
unset($_SESSION['cart']);
session_destroy();
?>
<script type="text/javascript">
    window.location = "../account/login.php";
</script>
<?php
?>