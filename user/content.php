<?php
include "../connect_db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <?php

            if (isset($_GET['view'])) {
                $t = $_GET['view'];
            } else {
                $t = '';
            }
            if ($t == 'add_to_cart') {

                include('./cart/cart.php');
                include('./search/search_categories.php');
            }
            // if ($t == 'add_to_cart') {
            //     include('./cart/cart.php');
            // } else
            if ($t == 'foodInfo') {
                include('sea_food_infor.php');
            }
            // elseif ($t == 'add_to_cart' || $t == 'delete' || $t == "update_cart") {
            //     include('./cart/cart.php');
            // } 
            else {
                include('./ads/advertisement.php');
                include('categories.php');
                include('all_products.php');
            }
            if (isset($_POST['cancel'])) {
                session_destroy();
            }
            ?>
        </div>
    </div>

</body>

</html>