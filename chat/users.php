<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
// exit;

?>
<?php include_once "../chat/header.php"; ?>

</html>

<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="stylesheet" href="./style.css">
</head>


<body class="sidebar-pinned ">

  <main class="admin-main">
    <h1>hEADER sHOP NAME = <?= $shopIF['shop_name'] ?></h1>

    <!-- PLACE CODE INSIDE THIS AREA -->

    <section class="manage-topic">
      <div class="container m-t-20">

        <div class="wrapper">
          <section class="users">
            <header>
              <div class="content">
                <?php
                $sql = mysqli_query($link, "SELECT user.*, shop.* FROM user INNER JOIN shop ON shop.shop_user_id = user.user_id WHERE `user_id` = $userId");
                if (mysqli_num_rows($sql) > 0) {
                  $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <img src="../shop/image_shop/<?php echo $row['shop_avatar']; ?>" alt="">
                <div class="details">
                  <span><?= $row['shop_name'] ?></span>
                  <p style="color:blue"><?php echo $row['session_status']; ?></p>
                </div>
              </div>
            </header>
            <div class="search">
              <span class="text">Select an user to start chat</span>
              <input type="text" placeholder="Enter name to search...">
              <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
          </section>
        </div>
      </div>

      <script src="../chat/javascript/users.js"></script>


    </section>
    <!--/ PLACE CODE INSIDE THIS AREA -->
  </main>
  <?php include "../partials/js_libs.php"; ?>

  <script>
    document.addEventListener("DOMContentLoaded", function(e) {


    });
  </script>


</body>

</html>