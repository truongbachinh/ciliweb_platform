<?php
include "../../config_shop.php";

if (isset($userId)) {

    $outgoing_id = $userId;
    $incoming_id = mysqli_real_escape_string($link, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($link, $_POST['message']);
    if (!empty($message)) {
        $sql = mysqli_query($link, "INSERT INTO `chat_messages` (`msg_id`, `msg_incoming_id`, `msg_outcoming_id`, `msg_message`) 
                                        VALUES (NULL,{$incoming_id}, {$outgoing_id}, '{$message}')") or die();
    }
} else {
    header("location: ../login.php");
}
