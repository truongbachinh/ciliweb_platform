<?php
session_start();
include "../connect_db.php";
$sessionStatus = "Offline now";
$id = $_SESSION['current_user']['user_id'];
$updateSessionStatus = $link->query("UPDATE `user` SET `session_status` = '$sessionStatus'  where `user_id` = '$id '");
session_destroy();
?>
<script type="text/javascript">
    window.location = "../account/login.php";
</script>
<?php
?>