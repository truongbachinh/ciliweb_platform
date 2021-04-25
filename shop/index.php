<?php
include "../config_shop.php";
$resultShopInfor = $link->query("SELECT * from shop where shop_user_id = '$userId'");
$shopInfor = mysqli_fetch_assoc($resultShopInfor);
if (!isset($_SESSION['current_user'])) {
    header("location: ../account/login.php");
}

if (isset($_GET['view'])) {
    $t = $_GET['view'];
} else {
    $t = '';
}


?>
<?php
if (isset($_POST["addShopInfor"])) {
    // File upload configuration 
    $tm = md5(time());
    $statusMsg = '';
    $uploadPath = "./image_shop/";
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $fileName =  $tm . basename($_FILES['shopImage']['name']);
    $targetFilePath = $uploadPath . $fileName;
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    // Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    if (!empty($fileName)) {

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["shopImage"]["tmp_name"], $targetFilePath)) {
                $addShop = $link->query("INSERT INTO `shop` (`shop_id`, `shop_user_id`, `shop_name`, `shop_address`, `shop_description`,`shop_phone`, `shop_avatar`, `shop_status`,`shop_rank`, `shop_create_time`) VALUES (NULL,'$userId','$_POST[shopName]','$_POST[shopAddress]','$_POST[shopDescription]','$_POST[shopPhone]','$fileName','1','1','" . $timeInVietNam . "')");
            }
            // var_dump($addShop);
            // exit;
            if ($addShop) {
?>
                <script type="text/javascript">
                    swal("Notice", "Adding shop information successfully!", "success");
                    window.location.replace("./index.php");
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("error !");
                    window.location.replace("./manage_categories.php");
                </script>
<?php
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside_shop.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header_shop.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->
        <?php

        if ($t == 'changepassword') {
            include('../account/change_password.php');
        } else {

        ?>
            <?php if (isset($shopInfor) == true) : ?>
                <div>
                    <?php include "./myshop.php"; ?>
                </div>
            <?php else : ?>
                <div class="container ">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-8">
                            <div class="card m-b-30 m-t-30 p-20">
                                <div class="col-md-9">
                                    <div class="m-t-15">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Shop Information
                                    </div>

                                    </h5>
                                    <div class="tab-infor m-b-15 p-l-30">
                                        <form action="" name="forml" method="post" id="addShopOnline" class="form" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="shopname">Shop name</label>
                                                <input type="text" class="form-control" id="shopname" name="shopName">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputshopDescription">Shop description</label>
                                                <input type="text" class="form-control" id="inputshopDescription" name="shopDescription">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputshopPhone">Shop phone</label>
                                                <input type="text" class="form-control" id="inputshopPhone" name="shopPhone">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress">Shop address</label>
                                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="shopAddress">
                                            </div>
                                            <!-- <div class="form-group">
                                                    <label for="inputshopImage">Shop avatar</label>
                                                    <input type="file" class="form-control" id="inputshopImage" name="shopImage">
                                                </div> -->


                                            <div class="form-group">
                                                <div>
                                                    <p class=" font-secondary">Shop avatar</p>
                                                    <div class="input-group mb-3">
                                                        <div onload="GetFileInfo ()">
                                                            <input type="file" class="custom-file-input" id="inputFile" name="shopImage" onchange="GetFileInfo ()">
                                                            <label class="custom-file-label" for="inputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div id="info" style="margin-top:10px"></div>
                                                </div>
                                            </div>

                                            <input type="submit" class="btn btn-primary" name="addShopInfor" value="Save changes">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

        <?php
        }
        ?>



        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        $(document).ready(function() {


            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-z," "]+$/i.test(value);
            }, "Letters and spaces only please");
            $('#addShopOnline').validate({
                rules: {
                    shopName: {
                        required: true,
                        lettersOnly: true,
                    },
                    shopDescription: {
                        required: true,

                    },
                    shopAddress: {
                        required: true,

                    },
                    shopImage: {
                        required: true,
                    },
                    shopPhone: {
                        required: true,
                        number: true,
                    }
                },
                messages: {
                    shopName: {
                        required: "Please provide information!",
                    },
                    shopDescription: {
                        required: "Please provide information!",
                    },
                    shopAddress: {
                        required: "Please provide shop address!",
                    },
                    shopImage: {
                        required: "Please shop avatar!",
                    },
                    shopPhone: {
                        required: "Please provide shop number phone!",
                        number: "Please provide only number phone!",
                    }
                },
            })
        })
        document.addEventListener("DOMContentLoaded", function(e) {

        })
    </script>
</body>

</html>