<?php
$link = mysqli_connect("localhost", "root", "", "ciliweb_database_platform");
$db_selected = mysqli_select_db($link, "ciliweb_database_platform");
$current = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
$timeInVietNam = $current->format('Y-m-d H:i:s');
