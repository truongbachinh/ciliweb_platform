<?php
include "../../config.php";
include "../../connect_db.php";
$userId = $_SESSION["current_user"]["user_id"];
if (isset($userId)) {

    $outgoing_id = $userId;
    $incoming_id = mysqli_real_escape_string($link, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($link, $_POST['message']);
    if (!empty($message)) {
        $sql = mysqli_query($link, "INSERT INTO `chat_messages` (`msg_id`, `msg_incoming_id`, `msg_outcoming_id`, `msg_message`,`msg_time`) 
                                        VALUES (NULL,{$incoming_id}, {$outgoing_id}, '{$message}', ' " . time() . "')") or die();
    }
    var_dump($outgoing_id);
    var_dump($incoming_id);
    var_dump($message);
    var_dump($sql);
    exit;
} else {
    header("location: ../login.php");
}
