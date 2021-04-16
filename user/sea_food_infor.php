<?php

$idCtg = $_GET["idl"];
$id = $_GET["id"];
$idShop = $_GET["idsh"];
$fileType = "";
$allowTypeImages = array('jpg', 'png', 'jpeg', 'gif', 'PNG');
$allowTypeVideos = array('mp4', 'mov', 'mpeg-2', 'flv');


$queryTotalUser = $link->query("SELECT COUNT(DISTINCT(reviews.review_user_id)) as total_user FROM reviews INNER JOIN user ON user.user_id = reviews.review_user_id INNER JOIN user_infor ON user_infor.ui_user_id = user.user_id WHERE review_product_id = '$id' AND review_shop_id = '$idShop'");
$totalU = $queryTotalUser->fetch_assoc();
$totalUser = $totalU['total_user'];
$queryTotalReview = $link->query("SELECT COUNT(reviews.review_comment) as total_review FROM reviews WHERE review_product_id = '$id' AND review_shop_id = '$idShop'");
$totalR = $queryTotalReview->fetch_assoc();
$totalReview = $totalR['total_review'];

$queryTotalSold = $link->query("SELECT COUNT(order_items.id) as total_sold FROM order_items INNER JOIN orders ON orders.id = order_items.order_id WHERE order_items.order_product_id = '$id' and orders.shipping_order_status = '3'");
$totalSold = $queryTotalSold->fetch_assoc();
$totalSoldOfShop = $totalSold['total_sold'];

$queryReview = $link->query("SELECT user.username, user_infor.ui_avatar, reviews.* FROM reviews INNER JOIN user ON user.user_id = reviews.review_user_id INNER JOIN user_infor ON user_infor.ui_user_id = user.user_id WHERE review_product_id = '$id' AND review_shop_id = '$idShop '");
$listReview = array();
if (!empty($queryReview)) {
    while ($rowReview = mysqli_fetch_array($queryReview)) {
        $listReview[] = $rowReview;
    }
}




$queryRating = $link->query("SELECT rank, COUNT(rank) as count_rater FROM reviews WHERE review_product_id = '$id' AND review_shop_id = '$idShop' GROUP BY rank");
$listRating = array();
if ($queryRating->num_rows > 0) {
    if (!empty($queryReview)) {
        while ($rowRating = mysqli_fetch_array($queryRating)) {
            $listRating[] = $rowRating;
        }
    }
    $rankOneRater = 0;
    $totalPerRankOneRater = 0;
    $totalRaterRank = 0;
    foreach ($listRating as $value) {
        $arraySum[] = $value['count_rater'];
        $rankOneRater = $value['rank'] * $value['count_rater'];
        $totalPerRankOneRater += $rankOneRater;
        $totalRater = array_sum($arraySum);
    }
    $totalRaterRank = $totalPerRankOneRater /  $totalRater;
    $viewTotalRate = (ROUND($totalRaterRank, 0));
}


$query_food = $link->query("SELECT categories.*, shop.*, products.* from products INNER JOIN shop ON shop.shop_id = products.p_shop_id INNER JOIN categories ON categories.ctg_id = products.p_category_id WHERE products.p_id = $id AND shop.shop_id = $idShop  AND categories.ctg_id = $idCtg");
$line_food = mysqli_fetch_array($query_food, MYSQLI_ASSOC);

$sql_img = $link->query("SELECT * FROM image_library Where `img_p_id` = $id");




$queryChat = $link->query("SELECT user.user_id, shop.shop_name FROM user INNER JOIN shop ON shop.shop_user_id = user.user_id WHERE shop.shop_id = $idShop");
$shopChat = mysqli_fetch_array($queryChat, MYSQLI_ASSOC);
$shopUserId = $shopChat['user_id']


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<link rel="stylesheet" href="./css/sea_food_infor.css">
<link rel="stylesheet" href="./css/chat.css">
<div class="seafood-infor" style="margin-top: 100px; ">
    <div id="breadcrumb"><i class="fa fas-home" style="margin-left: 9px;"> Sản phẩm của shop <i class="mdi mdi-arrow-right mdi-14px "></i><?php echo "<font>" . $line_food["shop_name"] . "</font>" ?></a></i>
    </div>
    <div class="infor">
        <form action="../cart/cart.php?view=add_to_cart" class="buy-form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-lg-6 " style="text-align: center;">
                    <div class="row-lg-5 row-md-5 row-5 list-imglist">
                        <div class="avatar-product">
                            <img src="../shop/image_products/<?php echo $line_food['p_image'] ?>" id="img-infor" class="img-fluid img-thumbnail ">
                        </div>
                        <div class="img-library">
                            <div class="list-img-library">
                                <div class="show-image-library">
                                    <div id="arrowL-Img">
                                        <i class="mdi mdi-chevron-left mdi:24px" aria-hidden="true" id="arrow-button"></i>
                                    </div>
                                    <div id="arrowR-Img">
                                        <i class="mdi mdi-chevron-right mdi:24px" aria-hidden="true" id="arrow-button"></i>
                                    </div>
                                    <div class="list">

                                        <div class="list-group list-group-horizontal col-lg-9 d-md-flex" id="view-list-libImg">
                                            <?php


                                            if ($sql_img->num_rows > 0) {
                                                while ($row = $sql_img->fetch_assoc()) {
                                                    $imageURL = '../shop/image_library/' . $row["img_name"];
                                            ?>
                                                    <div>
                                                        <a href="<?= $row['img_id'] ?>"> <img src="<?php echo $imageURL; ?>" alt="" width="70" height="70" class="img-fluid" id="img-view-details" />
                                                        </a>

                                                    </div>

                                                <?php }
                                            } else { ?>
                                                <p>No image(s) found...</p>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="col-md-6 col-lg-6 mb-4">
                    <div class="name-product">
                        <h4>Seafood Information</h4>
                    </div>
                    <div class="card-body justify-content-around rounded d-flex">

                        <div>
                            <p class="text-muted text-overline m-0">Total Rating star</p>
                            <div>
                                <?php
                                if ($queryRating->num_rows > 0) {
                                    $star =  $viewTotalRate;
                                    for ($i = 0; $i < 5; $i++) {
                                        $output = '<img class="star m-b-20" />';
                                        if ($i >=  $star) {
                                            $output = '<img class="starNull m-b-20" />';
                                        }
                                        echo  $output;
                                    }
                                } else {
                                ?>
                                    <small>No rater rating this product</small>
                                <?php
                                }

                                ?>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted text-overline m-0">Total user feedback</p>
                            <small><?= $totalUser ?></small>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td class="td-name">Product Categories :</td>
                                <td width="70%"><?= (!empty($line_food['ctg_name']) ? $line_food['ctg_name'] : "Null")  ?></td>
                            </tr>
                            <tr>
                                <td class="td-name">Product Name :</td>
                                <td width="70%"><?= (!empty($line_food['p_name']) ? $line_food['p_name'] : "Null")  ?></td>
                            </tr>

                            <tr>
                                <td class="td-name">Product Price :</td>
                                <td class="td-name-infor"><?= (!empty($line_food['p_price']) ? number_format($line_food['p_price'], 0, ",", ".") . ' VNĐ' : "Null")  ?></td>
                            </tr>
                            <tr>
                                <td class="td-name">Product Fresh :</td>
                                <td class="td-name-infor"><?= (!empty($line_food['p_fresh']) ? $line_food['p_fresh'] : "Null") ?>/10</td>
                            </tr>
                            <tr>
                                <td class="td-name">Product Date :</td>
                                <td width="70%"><?= (!empty($line_food['p_date_create']) ? date("Y-m-d H:i:s", $line_food['p_date_create']) : "Null") ?></td>
                            </tr>

                            <!-- <tr>
                                <td class="td-name">Product Amount :</td>
                                <td width="70%"> <input type="number" value="1" name="quantity[<?= $line_food['p_id'] ?>]">
                                    <span>Số lượng sẵn có <?php echo $line_food['p_quantity'] ?></span>
                                </td>
                            </tr> -->
                            <tr>
                                <td class="td-name">Product Count :</td>
                                <td>
                                    <div class="input-group" id="quantity-product">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quantity[<?= $line_food['p_id'] ?>]">
                                                <span><i class="fas fa-minus"></i></span>
                                            </button>
                                        </span>
                                        <input type="text" name="quantity[<?= $line_food['p_id'] ?>]" class="form-control input-number" value="1" min="1" max="<?= $line_food['p_quantity'] ?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quantity[<?= $line_food['p_id'] ?>]">
                                                <span><i class="fas fa-plus"></i></span>
                                            </button>
                                        </span>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    if ($line_food['p_quantity'] > 0) {
                    ?>
                        <div class="Buying">

                            <a onclick="chatToShop(<?= $shopUserId ?>)" name="chat" class="btn btn-info" role="button">
                                <i class="mdi mdi-pencil-outline"></i>
                            </a>
                            <!-- <a href="" class="btn btn-info  btn-show-shop-chat" role="button" data-id="<?= $shopUserId ?>"><i class="mdi mdi-chat"></i> </a> -->
                            <div class="verticalLine">
                            </div>
                            <input type="submit" name="buyProduct" class="btn btn-outline-danger" id="btn-danger-now" value="Order Now">
                            <div class="verticalLine">
                            </div>
                            <input type="submit" name="buyProduct" class="btn btn-danger" id="btn-danger" value="Add To Cart">
                        </div>

                    <?php
                    } else {
                    ?>
                        <strong class="alert alert-danger">Sold Out</strong>
                    <?php
                    }
                    ?>


                </div>
        </form>
    </div>
    <hr>
    <div class="modal fade" id="chatToShop" tabindex="-1" role="dialog" aria-labelledby="chatToShop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chatToShop">Chat with shop <?= $shopChat['shop_name'] ?></h5>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="wrapper">
                        <section class="chat-area">
                            <header>
                                <a href="./index.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                                <img src="" alt="" id="chatToShopAvatar">
                                <div class="details">
                                    <span id="chatToShopName"></span>
                                    <p id="chatToShopStatus"></p>
                                </div>
                            </header>
                            <div class="chat-box">

                            </div>
                            <form action="#" class="typing-area">
                                <input type="hidden" class="incoming_id" name="incoming_id" id="chatToShopId" value="<?= $shopUserId ?>">
                                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                                <button><i class="fab fa-telegram-plane"></i></button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="infor">
        <div id="breadcrumb-product-details"><i class="fa fas-home" style="margin-left: 9px;"> Chi tiết sản phẩm <i class="fal fa-chevron-right" style="font-size: 10px;"></i> <?php echo "<font>" . $line_food["p_name"] . "</font>" ?></a></i>
        </div>
        <div class="product-description">
            <p>Tên sản phẩm:
                <?= $line_food['p_description'] ?> </p>
            <span>
                <p>Tên sản phẩm
                </p>

                </p>
                <p> HƯỚNG DẪN BẢO QUẢN/ SỬ DỤNG

                </p>
                <p> CÁCH LÀM MỀM DA: Bản chất giày VNXK đầu tiên sẽ hơi cứng cáp Form, đặc biệt là giày liệu da tự nhiên 2 lớp như da bò tấm và những liệu da phủ bóng Nano thì sau khi đi khoảng 2 - 3 lần là Form sẽ bai và da sẽ mềm tự nhiên ra đó ạ!
                </p>
                <p> Tuy nhiên có mẹo nhỏ, có thể sử dụng máy sấy để tác động nhiệt cho liệu da Mềm và Form bai ra ngay ạ!

                </p>
                <p>BẢO QUẢN KHI KHÔNG SỬ DỤNG:
                </p>
                <p> - Mỗi sản phẩm giày tại bAimée &amp; bAmor, đều được đặt trong một hộp giày kèm giấy nến với túi chống ẩm. (Khi sử dụng giày, chị/em đừng vội vứt hộp, giấy nến hay túi chống ẩm đi nhé!)
                </p>
                <p> - Giày nên được để ở nơi thoáng mát. Nếu không thường xuyên sử dụng, có thể để vào hộp có túi hút ẩm, tránh để keo giày không bị thái hóa do lâu ngày không sử dụng.
                </p>
                <p> - Nên thường xuyên vệ sinh giày để giúp đôi giày luôn mới và tăng tuổi thọ của giày.
                </p>
                <p> - Ngoài ra nếu muốn làm sạch giày bạn có thể sử dụng GEL đa năng làm sạch của Thailand, khi muốn làm sạch sâu hơn bạn có thể giặt giày bằng cách sử dụng nước rửa bát và bàn chải đánh răng hoặc kem đánh răng và bàn chải đánh răng (tuyệt đối ko sử dụng xà phòng và bàn chải thông thường!) để vệ sinh phần đế và làm sạch giày ạ!
                </p>
                <p> ------------------------------------------------</p>

            </span>
        </div>
    </div>
    <div class="infor">
        <div id="breadcrumb-product-details"><i class="fa fas-home" style="margin-left: 9px;"> Feedback of product <i class="fal fa-chevron-right" style="font-size: 10px;"></i> <?php echo "<font>" . $line_food["p_name"] . "</font>" ?></a></i>
        </div>
        <div class="feadback-description">
            <div class="col-lg-12 col-md-12">
                <div class="card m-b-30 m-t-30">
                    <div class="card-body justify-content-around rounded d-flex">

                        <div>
                            <p class="text-muted text-overline m-0">Total Rating star</p>
                            <img class="starNull" />
                        </div>
                        <div>
                            <p class="text-muted text-overline m-0">Total user feedback</p>
                            <small><?= $totalUser ?></small>
                        </div>
                        <div>
                            <p class="text-muted text-overline m-0">Total feedback content</p>
                            <small><?= $totalReview ?></small>
                        </div>
                        <div>
                            <p class="text-muted text-overline m-0">Total Sold</p>
                            <small><?= $totalSoldOfShop ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card m-b-30 m-t-30">
                    <?php
                    foreach ($listReview  as $reviewInfor) {
                    ?>

                        <ul class="list-group list-group-flush" width: 90%;>
                            <li class="list-group-item">
                                <div class="avatar avatar-sm">
                                    <?php
                                    if ($queryReview->num_rows > 0) {
                                        $imageURL = '../user/avatar/' . $reviewInfor["ui_avatar"];
                                    ?>
                                        <img class="avatar-img rounded-circle  m-l-25" src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />

                                    <?php
                                    } else { ?>
                                        <span class="avatar-title rounded-circle bg-warning">Hidden</span>

                                    <?php } ?>
                                </div>
                                <p>Account:<?= $reviewInfor["username"] ?></p>

                                <div>
                                    <?php
                                    $star =   $reviewInfor['rank'];
                                    for ($i = 0; $i < 5; $i++) {
                                        $output = '<img class="star m-b-20" />';
                                        if ($i >=  $star) {
                                            $output = '<img class="starNull m-b-20" />';
                                        }
                                        echo  $output;
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($queryReview->num_rows > 0) {
                                        $imageReviewURL = '../user/review_image/' . $reviewInfor["review_image"];
                                        $fileType = pathinfo($imageReviewURL, PATHINFO_EXTENSION);
                                        if (in_array($fileType, $allowTypeImages)) {
                                    ?>
                                            <img class="" src="<?php echo $imageReviewURL; ?>" alt="" height="70" width="70" style="border-radius:10px" />

                                        <?php
                                        }
                                        if (in_array($fileType, $allowTypeVideos)) {
                                        ?>
                                            <video width="150" height="150" controls>
                                                <source src="<?php$imageReviewURL ?>" type="video/mp4">
                                            </video>
                                        <?php
                                        }
                                    } else { ?>
                                        <span class="avatar-title rounded-circle bg-warning">Hidden</span>

                                    <?php }
                                    ?>


                                    <p>Content:<?= $reviewInfor['review_comment'] ?></p>
                                    <small><?= date('Y-d-M H:i:s', $reviewInfor['review_time']) ?></small>
                                </div>
                            </li>

                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    const form = document.querySelector(".typing-area"),


        incoming_id = form.querySelector('input[name=incoming_id]').value,
        inputField = form.querySelector(".input-field"),
        sendBtn = form.querySelector("button"),
        chatBox = document.querySelector(".chat-box");

    form.onsubmit = (e) => {
        e.preventDefault();
    }

    inputField.focus();
    inputField.onkeyup = () => {
        if (inputField.value != "") {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    }

    sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../chat/php/user_insert_chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = "";
                    scrollToBottom();
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    }

    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    }

    setInterval(() => {
        console.log(incoming_id);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../chat/php/user_get_chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("incoming_id=" + incoming_id);
    }, 500);

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {

        var $item = $('div#view-list-libImg'), //Cache your DOM selector
            visible = 3, //Set the number of items that will be visible
            index = 0, //Starting index
            endIndex = ($item.length / visible) - 1; //End index

        $('div#arrowR').click(function() {
            debugger;

            if (index < endIndex) {
                index++;
                $item.animate({
                    'left': '-=300px'
                });
            }
        });

        $('div#arrowL').click(function() {
            if (index > 0) {
                index--;
                $item.animate({
                    'left': '+=300px'
                });
            }
        });

    });

    $('.btn-number').click(function(e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function() {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>
<?php


?>