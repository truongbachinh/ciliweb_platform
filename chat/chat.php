<?php
include("../config.php");
$talker = $_GET['user_id'];
$userId = $_SESSION["current_user"]["user_id"];
if (!isset($userId)) {
  header("location: ../account/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($link, $talker);
        $sql = mysqli_query($link, "SELECT user.*, user_infor.* FROM user INNER JOIN user_infor ON user_infor.ui_user_id = user.user_id WHERE `user_id` = {$talker}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users.php");
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../user/avatar/<?php echo $row['ui_avatar']; ?>" alt="">
        <div class="details">
          <span><?php echo  $row['fullname'] ?></span>
          <p><?php echo $row['session_status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <!-- <script src="../chat/javascript/chat.js"></script> -->

</body>

</html>