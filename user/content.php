<?php

if (isset($_GET['view'])) {
    $t = $_GET['view'];
} else {
    $t = '';
}

if ($t == 'foodInfo') {
    include('sea_food_infor.php');
} elseif ($t == 'profile') {
    include('profile.php');
} elseif ($t == 'changepass') {
    include('../account/change_password.php');
} elseif ($t == 'myorder') {
    include('../user/my_order.php');
} elseif ($t == 'conversation') {
    include('../user/talk_to_shop.php');
} elseif ($t == 'my_order-detail') {
    include('../user/my_bill.php');
} else {

    include('../user/advertisement.php');
    include('../user/categories.php');
    include('../user/shop_providers.php');
?>
    <div class="container-fluid result-search">
        <div id="title-categories">
            <p style="background: #7abaa1;
    padding: 10px;
    border-left: 5px solid #ff284b;
    font-weight: bold;
    font-size: 18px;
    border-radius:12px;
    color:white">
                All Of Product
            </p>
        </div>
    <?php
    include('../user/seafood.php');
}
