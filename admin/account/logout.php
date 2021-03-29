<?php
session_start();
include "../../connect_db.php";

unset($_SESSION['current_username']);
?>
<script type="text/javascript">
    window.location = "login.php";
</script>