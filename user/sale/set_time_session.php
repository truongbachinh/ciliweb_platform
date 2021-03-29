<?php
session_start();
include "./user/connect_db.php";
$exam_for_user = $_GET["exam_for_user"];
$_SESSION["exam_for_user"] = $exam_for_user;
$res = mysqli_query($link, "select * from exam_for_user where exam='$exam_for_user'");
while ($row = mysqli_fetch_array($res)) {
    $_SESSION["exam_time"] = $row["time_do_exam"];
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$date = date("Y-m-d H:i:s");
$_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date . "+$_SESSION[exam_time] minutes"));
$_SESSION["exam_start"] = "yes";
