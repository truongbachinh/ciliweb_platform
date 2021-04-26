<?php
//Hàm login sau khi mạng xã hội trả dữ liệu về
function loginFromSocialCallBack($socialUser)
{
    include "../connect_db.php";

    $result = mysqli_query($link, "SELECT user.* from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    if ($result->num_rows == 0) {
        $result = mysqli_query($link, "INSERT INTO `user` (`fullname`,`email`, `user_status`,`user_role_id`,`user_create_time`) VALUES ('" . $socialUser['name'] . "', '" . $socialUser['email'] . "', '1','2','$timeInVietNam');");
        if (!$result) {
            echo mysqli_error($link);
            exit;
        }
        $result = mysqli_query($link, "SELECT user.* from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    }
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['current_user'] = $user;

        header('Location: ../account/login.php');
    }
}



function loginWithGoogle($socialUser)
{
    include "../connect_db.php";

    $result = mysqli_query($link, "SELECT user.* from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    if ($result->num_rows == 0) {
        $result = mysqli_query($link, "INSERT INTO `user` (`fullname`,`email`, `user_status`,`user_role_id`,`user_create_time`) VALUES ('" . $socialUser['name'] . "', '" . $socialUser['email'] . "', '1','2','$timeInVietNam');");
        if (!$result) {
            echo mysqli_error($link);
            exit;
        }
        $result = mysqli_query($link, "Select user.* from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    }
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['current_user'] = $user;
        header('Location: ../account/login.php');
    }
}
