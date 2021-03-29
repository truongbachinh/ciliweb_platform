<!DOCTYPE html>
<html>

<head>
    <title>ChinhTB </title>
    <meta http-equiv='content-type' content='charset=utf-8'>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/all_products.css">
    <!-- font-cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <!-- bootstrap 4 cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jquery 4 cdn -->
    <link src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">

    </link>
    <!-- fancybox css -->
    <link rel="stylesheet" href="./library/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/categories.css">
    </link>
</head>



<body>



    <?php
    session_start();
    ?>
    <div class="heaeder-content">
        <?php
        include('header.php');
        ?>
    </div>

    <div>
        <?php
        include('config.php');
        ?>

    </div>


    <div class="container-fluid">
        <?php
        include('content.php');
        ?>
    </div>
    <div class="container-fluid">
        <?php include('footer.php'); ?>
    </div>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- fancybox -->
    <script type="text/javascript" src="./library/fancybox/jquery.fancybox.min.js"></script>
</body>

</html>