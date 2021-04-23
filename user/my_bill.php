<?php
$idOrder = $_GET["id"];
$billDetail = "SELECT order_address.*, orders.*, order_items.*,user.*, products.p_name as order_product_name, products.p_image as order_product_image, products.p_id as product_id from orders INNER JOIN order_items ON orders.id = order_items.order_id INNER JOIN products ON products.p_id = order_items.order_product_id INNER JOIN user ON user.user_id = orders.order_user_id INNER JOIN order_address ON order_address.oda_order_id = orders.id WHERE orders.id  = $idOrder AND order_user_id = $userId";
$res = mysqli_query($link, $billDetail);
$bill = array();

while ($row = mysqli_fetch_array($res)) {
    $bill[] = $row;
    $firstName = $row['oda_firstname'];
    $lastName = $row['oda_lastname'];
    $address = $row['oda_address'];
    $city = $row['oda_city'];
    $district = $row['oda_district'];
    $phone = $row['oda_phone'];
    $orderTime = $row['order_create_time'];
}
$isFB  = $link->query("SELECT orders.shipping_order_status as order_status FROM orders WHERE orders.id = $idOrder");
$isFeedback = mysqli_fetch_assoc($isFB);
?>



<link rel="stylesheet" href="./css/rate.css">
<link rel="stylesheet" href="./css/bill.css">
<section class="manage-topic">
    <div class="container m-t-30">
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h1 class="bill-title"> <i> Bill Detail</i> </h1>
                        </div>
                        <div id="order-time">
                            <p class="bill-title">Time order, <?= date('d-M-Y  H:i:s', strtotime($orderTime))  ?> </p>
                        </div>
                    </div>
                    <hr class="hr-line">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 m-l-20">
                                <div class="card-title">
                                    <h3 class=" bill-information">Receiver's information:</h3>
                                </div>
                                <div class="card-text">
                                    <p class="infor"><b> Receiver name:</b> &nbsp;<span><?= $firstName, " ",  $lastName ?></span></p>
                                    <p class="infor"><b> Address:</b> &nbsp;<span><?= $address ?></span><br></p>
                                    <p class="infor"><b> Township / District:</b> &nbsp;<span><?= $district ?></span><br></p>
                                    <p class="infor"><b> Province / City:</b> &nbsp;<span><?= $city ?></span><br></p>
                                    <p class="infor"><b> Phone:</b> &nbsp; <span><?= $phone ?></span><br></p>
                                </div>
                            </div>
                            <hr class="hr-line">
                            <div class="col-lg-12 ">
                                <div class="card-title m-l-20">
                                    <h3 class=" bill-information"> Product list:</h3>
                                </div>
                                <div class="table-responsive p-t-30">
                                    <table class="table">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Product name</th>
                                                <th>Image</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <?php
                                                if ($isFeedback['order_status'] == '3') {
                                                ?>
                                                    <th>Feedback</th>
                                                <?php
                                                }
                                                ?>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            $totalMoney = 0;
                                            $count = 0;
                                            $totalQuantity = 0;
                                            $i = 1;
                                            foreach ($bill as $order) {
                                            ?>
                                                <tr>
                                                    <td class="bill-product"><?= $i++ ?></td>
                                                    <td class="bill-product"><?= $order["order_product_name"] ?></td>
                                                    <?php
                                                    if ($res->num_rows > 0) {
                                                        $imageURL = "../shop/image_products/" . $order["order_product_image"];
                                                    ?>
                                                        <td class="bill-product">
                                                            <img src="<?php echo $imageURL; ?>" alt="" width="70" height="70" class="img-fluid" id="img-view-details" />


                                                        </td>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td class="bill-product">
                                                            <p>No image(s) found...</p>
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td class="bill-product"><?= number_format($order["price"], 0, ",", ".") ?>VNĐ</td>
                                                    <td class="bill-product"><?= $order["quantity"] ?></td>
                                                    <td class="bill-product"><?= number_format($cost = $order["quantity"] * $order["price"], 0, ",", ".") ?>VNĐ</td>
                                                    <?php

                                                    if ($isFeedback['order_status'] == '3') {


                                                    ?>
                                                        <td style="text-align:center">
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <button onclick="feedbackProduct(<?= $order['product_id'] ?>)" class="btn btn-info" role="button">
                                                                    <i class="mdi mdi-pencil-outline"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>


                                                </tr>
                                            <?php
                                                $count += $order["quantity"];
                                                $total += $cost;
                                            }
                                            $totalQuantity += $count;
                                            $totalMoney += $total;

                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="total-bill col-md-4 m-r-10 m-t-20 m-b-20">
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Total Quantity</span>
                                                <strong><?= $totalQuantity ?></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Total Cost</span>
                                                <strong><?= number_format($totalMoney, 0, ",", ".") ?>VNĐ</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr class="hr-line">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal edit -->
        <div class="modal fade" id="feedbackProductFrom" tabindex="-1" role="dialog" aria-labelledby="feedbackProductFrom" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feedbackProductFrom">Feedback for product</h5>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="edit-order-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="fbProductId" class="form-control" id="fbProductId">
                                <input type="hidden" name="fbShopId" class="form-control" id="fbShopId">
                            </div>
                            <div class="form-group">
                                <label for="">Shop:</label>
                                <label for="fbProductShop" id="fbProductShop"></label>
                            </div>
                            <div class="form-group">
                                <label for="">Product name:</label>
                                <label for="fbProductName" id="fbProductName"></label>
                            </div>
                            <div class="form-group">
                                <label for="">Product image:</label>
                                <img src="" alt="No avatar" id="detailProduct" width="50" height="50">
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <div class="form-group">
                                        <div class="rate2"></div>
                                        <input id="reviewRank" name="reviewRankInput" type="hidden">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="control-label">Image :</label>
                                        <input type="file" class="p11" class="form-control" id="reivewImageProduct" name="reivewImageProduct">
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label">video :</label>
                                        <input type="file" class="p11" class="form-control" id="reivewVideoProduct" name="reivewVideoProduct">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""> Review Content</label>
                                <input type="text" name="reviewContent" class="form-control" id="reviewContent">
                            </div>
                            <div class="model-footer" style="float: right;">
                                <button type="submit button" name="reviewProduct" class="btn btn-warning btn-feedback-product">
                                    Save Changes
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

if (isset($_POST['reviewProduct'])) {
    $idProduct =  $_POST['fbProductId'];
    $idShop = $_POST['fbShopId'];
    $reviewRank =  $_POST['reviewRankInput'];
    $reviewContent =  $_POST['reviewContent'];
    $timeReview = $timeInVietNam;


    // $tm = md5(time());
    $statusMsgImage = '';
    $statusMsgVideo = '';

    // $uploadVideoPath = "./review_video/";
    // if (!is_dir($uploadVideoPath)) {
    //     mkdir($uploadVideoPath, 0777, true);
    // }
    $uploadImagePath = "./review_image/";
    if (!is_dir($uploadImagePath)) {
        mkdir($uploadImagePath, 0777, true);
    }

    // $uploadImage = false;
    // $uploadVideo = false;
    // $fileNameImage = basename($_FILES['reivewImageProduct']['name']);
    // $fileNameVideo = basename($_FILES['reivewVideoProduct']['name']);
    $fileNameImage =  $tm . basename($_FILES['reivewImageProduct']['name']);
    $fileNameVideo =  $tm . basename($_FILES['reivewVideoProduct']['name']);
    $targetImageFilePath = $uploadImagePath . $fileNameImage;
    $targetVideoFilePath = $uploadImagePath . $fileNameVideo;
    $uploadImage = move_uploaded_file($_FILES["reivewImageProduct"]["tmp_name"], $targetImageFilePath);
    $uploadVideo = move_uploaded_file($_FILES["reivewVideoProduct"]["tmp_name"], $targetVideoFilePath);
    // $allowTypeImages = array('jpg', 'png', 'jpeg', 'gif');
    // $allowTypeVideos = array('mp4', 'mov', 'mpeg-2', 'flv');
    // // Check whether file type is valid 
    // $fileTypeImage = pathinfo($targetImageFilePath, PATHINFO_EXTENSION);
    // // Check whether file type is valid 
    // $fileTypeVideo = pathinfo($targetVideoFilePath, PATHINFO_EXTENSION);
    // if (!empty($fileNameImage)) {

    //     if (in_array($fileTypeImage, $allowTypeImages)) {
    //         if (move_uploaded_file($_FILES["imageProduct"]["tmp_name"], $targetImageFilePath)) {
    //             $statusMsgImage = 'Upload oke';
    //         }
    //     } else {
    //         $statusMsgImage = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    //     }
    // } else {
    //     $statusMsgImage = 'Please select a image file to upload.';
    // }

    // if (!empty($fileNameVideo)) {

    //     if (in_array($fileTypeVideo, $allowTypeVideos)) {
    //         if (move_uploaded_file($_FILES["imageProduct"]["tmp_name"], $targetVideoFilePath)) {
    //             $uploadVideo = true;
    //             $statusMsgVideo = 'oke';
    //         }
    //     } else {
    //         $statusMsgVideo = 'Sorry, only mp4 mov mpeg-2 flv  files are allowed to upload.';
    //     }
    // } else {
    //     $statusMsgVideo = 'Please select a video file to upload.';
    // }
    var_dump($uploadImage);
    var_dump($uploadVideo);
    var_dump($fileNameImage);
    var_dump($fileNameVideo);


    $queryInsertReivew = $link->query("INSERT INTO `reviews` (`review_id`, `review_user_id`, `review_product_id`, `review_image`, `review_video`, `rank`, `review_comment`, `review_time`) VALUES (NULL, '$userId',' $idProduct','$fileNameImage',' $fileNameVideo','$reviewRank',  '$reviewContent', '  $timeReview');");

    var_dump($queryInsertReivew);
}
?>