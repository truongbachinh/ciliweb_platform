<?php
ob_start();
?>


<link rel="stylesheet" href="../partials/css/header_user.css">
<header class="user-header">
    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
    <nav class=" ml-auto">
        <ul class="nav align-items-center m-r-30">
            <li class=nav-item>
                <div class="d-flex p-all-15  justify-content-between">
                    <a href="#!" class="nar-link"><i class="mdi mdi-24px mdi-chat"></i>
                        <!-- <span class="notification-counter"></span></a> -->
            </li>
            <?php if (!empty($_SESSION["current_user"]) && $_SESSION["current_user"]['user_role_id'] == '2' &&  $_SESSION["current_user"]['user_status'] == '1') : ?>
                <div class="header-content">
                    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                        <a class="navbar-brand" href="../user/index.php" id="logo-brand">
                            <i class="fas fa-home"></i> Seller channel
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ciliweb-navBar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="ciliweb-navBar">
                            <ul class="navbar-nav ml-auto ">
                                <li class="nav-item active">
                                    <form action="" method="post">
                                        <div style="margin-right: 15px; ">
                                            <button type="submit" class="btn btn-outline-danger" name="cartBT"> <span id="cartCountHeader"><?php include "../partials/cart_count.php" ?></span></i>
                                                </span></button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                            <?php
                            if (isset($_POST["cartBT"])) {

                                header("location: ../cart/cart.php");
                            }
                            ?>
                            <ul class="navbar-nav ">
                                <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <?php
                                        if ($resultUserInfor->num_rows > 0) {
                                            $imageURL = '../user/avatar/' . $rowUser["ui_avatar"];
                                        ?>
                                            <div class="avatar avatar-sm avatar-online">
                                                <img class="avatar-img rounded-circle" src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                            </div>
                                        <?php
                                        } else { ?>
                                            <div class="btn btn-outline-warning">
                                                <span style="color:aliceblue"><?php if (!empty($_SESSION["current_user"]["username"])) {
                                                                                    echo $_SESSION["current_user"]["username"];
                                                                                } else {
                                                                                    echo $_SESSION["current_user"]["fullname"];
                                                                                } ?></span>
                                            </div>
                                        <?php } ?>



                                    </a>
                                    <div class="dropdown-menu  dropdown-menu-right">
                                        <a href="../user/index.php?view=profile" class="dropdown-item"> Profile</a>
                                        <a href="../user/index.php?view=conversation" class="dropdown-item"> My conversation</a>
                                        <a href="../user/index.php?view=myorder" class="dropdown-item"> My Order</a>
                                        <a href="../user/index.php?view=changepass" class="dropdown-item"> Reset Password</a>

                                        <div class="dropdown-divider"></div>
                                        <a href="../account/logout.php" class="dropdown-item"> Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                        <a class="navbar-brand" href="../account/login.php">
                            <img src="https://ciliweb.vn/ciliweb_project/user/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="55" height="55">
                        </a>
                        <div class="collapse navbar-collapse">
                        </div>
                    </nav>
                    <section class="search-bar search-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-5 col-6 mx-auto ">
                                    <form action="">
                                        <div class="input">
                                            <div class="input-group">
                                                <input type="text" class="form-control empty d-flex justify-content-center search-box" id="keywords" placeholder="Type keywords..." onkeyup="searchFilterDelay();" />
                                                <div style="position: relative; cursor: pointer">
                                                    <i style="position: absolute; z-index:1; " class=" fa fa-microphone fa-lg iconVoice" onclick='startRecording(); '></i>
                                                    <input type='button' class="inputVoice cursor-pointer form-control empty d-flex justify-content-center search-box col-1" id='start'>
                                                </div>
                                                <select class="form-control empty d-flex justify-content-center search-box col-2" id="sortBy" onchange="searchFilter();">
                                                    <option value="">Sort by Price</option>
                                                    <option value="asc"> Low to high</option>
                                                    <option value="desc">High to low</option>
                                                </select>
                                                <?php
                                                ?>
                                                <script>
                                                    var recognition = new webkitSpeechRecognition();

                                                    recognition.onresult = function(event) {
                                                        var saidText = "";
                                                        for (var i = event.resultIndex; i < event.results.length; i++) {
                                                            if (event.results[i].isFinal) {
                                                                saidText = event.results[i][0].transcript;
                                                            } else {
                                                                saidText += event.results[i][0].transcript;
                                                            }
                                                        }
                                                        // Update Textbox value
                                                        document.getElementById('keywords').value = saidText;
                                                        // Search Posts
                                                        searchFilterDelay(saidText);
                                                    }

                                                    function startRecording() {
                                                        recognition.start();
                                                    }

                                                    function endRecording() {
                                                        recognition.end();
                                                    }
                                                </script>
                                                <?php

                                                ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>



                <div class="nav-item m-r-3">
                    <a href="#">
                        <b><?= $_SESSION['current_user']['username'] ?></b>
                    </a>
                </div>

            <?php else : ?>
                <div class="header-content">
                    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                        <a class="navbar-brand" href="../user/index.php" id="logo-brand">
                            <i class="fas fa-home"></i> Seller channel
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ciliweb-navBar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="ciliweb-navBar">
                            <ul class="navbar-nav mr-auto ">
                                <li class="nav-item active">

                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto ">
                                &nbsp;
                                <li class="nav-item">
                                    <a class="nav-link " id="login" href="../account/login.php"><i class="fas fa-sign-in-alt"></i>Log in</a>
                                </li>
                                <div class="verticalLine">

                                </div>
                                <li class="nav-item">
                                    <a class="nav-link " id="sign-up" href="../account/register.php"><i class="fas fa-user-plus"></i>Sign up</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
                        <a class="navbar-brand" href="https://ciliweb.vn/ciliweb_project/shop/register_shop.php">
                            <img src="https://ciliweb.vn/ciliweb_project/user/images/ciliweb.png" class="rounded-circle" id="img-logo" alt="Logo Cili" width="55" height="55">
                        </a>
                        <div class="collapse navbar-collapse">
                        </div>
                    </nav>
                    <section class="search-bar search-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-5 col-6 mx-auto ">
                                    <form action="">
                                        <div class="input">
                                            <div class="input-group">
                                                <input type="text" class="form-control empty d-flex justify-content-center search-box" id="keywords" placeholder="Type keywords..." onkeyup="searchFilterDelay();" />
                                                <div style="position: relative; cursor: pointer">
                                                    <i style="position: absolute; z-index:1; " class=" fa fa-microphone fa-lg iconVoice" onclick='startRecording(); '></i>
                                                    <input type='button' class="inputVoice cursor-pointer form-control empty d-flex justify-content-center search-box col-1" id='start'>
                                                </div>
                                                <select class="form-control empty d-flex justify-content-center search-box col-2" id="sortBy" onchange="searchFilter();">
                                                    <option value="">Sort by Price</option>
                                                    <option value="asc"> Low to high</option>
                                                    <option value="desc">High to low</option>
                                                </select>
                                                <?php
                                                ?>
                                                <script>
                                                    var recognition = new webkitSpeechRecognition();

                                                    recognition.onresult = function(event) {
                                                        var saidText = "";
                                                        for (var i = event.resultIndex; i < event.results.length; i++) {
                                                            if (event.results[i].isFinal) {
                                                                saidText = event.results[i][0].transcript;
                                                            } else {
                                                                saidText += event.results[i][0].transcript;
                                                            }
                                                        }
                                                        // Update Textbox value
                                                        document.getElementById('keywords').value = saidText;
                                                        // Search Posts
                                                        searchFilterDelay(saidText);
                                                    }

                                                    function startRecording() {
                                                        recognition.start();
                                                    }

                                                    function endRecording() {
                                                        recognition.end();
                                                    }
                                                </script>
                                                <?php

                                                ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>





            <?php endif; ?>
        </ul>

    </nav>
</header>
<script type="text/javascript">
    // $("#cartBT").submit(function(event) {
    //     event.preventDefault();
    //     console.log("data", $(this).serializeArray());

    //     $.ajax({
    //         type: "POST",
    //         url: '../cart_count.php',
    //         data: $(this).serializeArray(),
    //         success: function(response) {
    //             response = JSON.parse(response);
    //             if (response.status == 0) {

    //             } else {
    //                 // alert(response.message);
    //                 // $.get('../cart_count.php', function(cartCountHTML) {
    //                 //     console.log("cart-count", cartCountHTML);
    //                 //     $('#cartCountHeader').html(cartCountHTML);
    //                 // })
    //                 <?php
                        //                 var_dump($_POST["cartBT"]);
                        //                 exit;
                        //                 header("location: ./cart/cart.php");
                        //                 
                        ?>
    //             }
    //         }

    //     })


    // })
</script>