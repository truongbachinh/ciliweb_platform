<?php
include "../../config.php";
$userId = $_SESSION["current_user"]["user_id"];
if (isset($userId)) {

    $outgoing_id = $userId;
    $incoming_id = mysqli_real_escape_string($link, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT chat_messages.*, user.fullname,user_infor.ui_avatar FROM chat_messages LEFT JOIN user ON user.user_id = chat_messages.msg_outcoming_id LEFT JOIN user_infor ON user_infor.ui_user_id = user.user_id 
                WHERE (msg_outcoming_id = {$outgoing_id} AND msg_incoming_id = {$incoming_id})
                OR (msg_outcoming_id = {$incoming_id} AND msg_incoming_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($link, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['msg_outcoming_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg_message'] . '</p>
                                    <small>' . date("Y-d-M H:i:s", $row['msg_time']) . '</small>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="../../user/avatar/' . $row['ui_avatar'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['msg_message'] . '</p>
                                    <small>' . date("Y-d-M H:i:s", $row['msg_time']) . '</small>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}
