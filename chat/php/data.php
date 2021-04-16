<?php
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM chat_messages WHERE (msg_incoming_id = {$row['user_id']}
                OR msg_outcoming_id = {$row['user_id']}) AND (msg_outcoming_id = {$outgoing_id} 
                OR msg_incoming_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($link, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg_message'] : $result = "No message available";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['msg_outcoming_id'])) {
        ($outgoing_id == $row2['msg_outcoming_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }
    ($row['session_status'] == "Offline now") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['user_id']) ? $hid_me = "hide" : $hid_me = "";

    $avatar = '../user/avatar/' . $row['ui_avatar'];
?>
    <a href="" class="btn-chat-user" role="button" data-id="<?php echo $row['user_id'] ?>">
        <div class=" content">
            <img src="<?= $avatar ?>" alt="">
            <div class="details">
                <span><?= $row['fullname'] ?></span>
                <p><?= $you . $msg ?></p>
                <small><?= date("H:i:s", $row2['msg_time']) ?></small>

            </div>
        </div>
        <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
    </a>
<?php
}
