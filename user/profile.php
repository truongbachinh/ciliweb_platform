<?php
include "../config_user.php";
$resultShopInfor = $link->query("SELECT * from shop where shop_user_id = '$userId'");
$shopInfor = mysqli_fetch_assoc($resultShopInfor);

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
                $addShop = $link->query("INSERT INTO `shop` (`shop_id`, `shop_user_id`, `shop_name`, `shop_address`, `shop_description`, `shop_avatar`, `shop_status`, `shop_create_time`) VALUES (NULL,'$userId','$_POST[shopName]','$_POST[shopAddress]','$_POST[shopDescription]','$fileName','1','" . time() . "')");
            }
            // var_dump($addShop);
            // exit;
            if ($addShop) {
?>
                <script type="text/javascript">
                    alert("add shop success !");
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
    <?php include "../partials/aside_user.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header_user.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->

        <h1>Hello World</h1>
        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {

        })
    </script>
</body>

</html>