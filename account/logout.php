<?php
session_start();
include "../connect_db.php";

unset($_SESSION['access_token']);
unset($_SESSION['current_user_social']);
unset($_SESSION['current_user']);
unset($_SESSION['cart']);

?>
<script type="text/javascript">
    window.location = "../account/login.php";
</script>
<?php
?>