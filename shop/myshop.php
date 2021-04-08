<!DOCTYPE html>
<html lang="en">



<body class="sidebar-pinned ">
    <!-- PLACE CODE INSIDE THIS AREA -->
    <section class="admin-content">
        <div class="container m-t-30">
            <div class="row justify-content-md-center">
                <div class="col-lg-8">
                    <div class="card m-b-30">
                        <div class="card-media">
                            <img class="card-img-top " src="../images/ciliweb.png" height="300" style="border-radius:5px" alt="banner">
                        </div>
                        <div class="card-body">
                            <div class="text-center pull-up-sm">
                                <div class="avatar avatar-xxl">
                                    <?php
                                    if ($resultShopInfor->num_rows > 0) {
                                        $imageURL = '../shop/image_shop/' . $rowShop["shop_avatar"];
                                    ?>
                                        <img class="avatar-img rounded-circle" src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                    <?php
                                    } else { ?>
                                        <img class="avatar-img rounded-circle" src="../images/ciliweb.png" alt="" height="50" width="50" style="border-radius:10px" />

                                    <?php } ?>

                                </div>
                                <h4 class="text-center m-t-20">
                                    <div class="text text-center m-b-5"><?= $rowShop["shop_name"] ?></div>
                                </h4>
                            </div>
                            <!-- Modal edit profile -->
                            <div class="row justify-content-end p-r-40">
                                <button type="button" class="btn btn-sm btn-primary btn-update-shop" role="button" data-id="<?= $rowShop['shop_id'] ?>" data-toggle="modal" data-target="#updateShopProfile">
                                    Update shop profile
                                </button>


                                <!-- Model edit -->
                                <div class="modal fade" id="updateShopProfile" tabindex="-1" role="dialog" aria-labelledby="updateShopProfile" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateShopProfile">Update profile
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" name="forml" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="updateName">Shop name</label>
                                                        <input type="hidden" class="form-control" id="shopId" name="shopId">
                                                        <input type="text" class="form-control" id="updateName" name="updateName">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="updateDescription">Shop Description</label>
                                                        <input type="text" class="form-control" id="updateDescription" name="updateDescription">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="updateAddress">Shop address</label>
                                                        <input type="text" class="form-control" id="updateAddress" placeholder="1234 Main St" name="updateAddress">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="updateAvatar">Shop avatar</label>
                                                        <img src="<?php echo $imageURL; ?>" alt="" width="50" height="50" style="display: flex; flex-direction:row; margin:10px 20px" />
                                                        <input type="file" class="form-control" id="updateAvatar" name="updateAvatar">
                                                    </div>
                                                    <!-- <div class="form-group editRankShop">
                                                        <label for="updateRankShop">Shop rank</label>
                                                        <select id="updateRankShop" class="form-control">
                                                            <option value="1">Silver</option>
                                                            <option value="2">Gold</option>
                                                            <option value="3">Platinum</option>
                                                            <option value="4">Diamond</option>
                                                        </select>
                                                    </div> -->
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <input type="submit" class="btn btn-primary btn-save-update-shop" name="btnUpdateShopProfile" value="Save changes">
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-9">
                                    <div class="tab-infor m-b-15">
                                        <ul class="nav nav-tabs" id="myTabInforStudent" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#inforStudent" role="tab" aria-controls="home" aria-selected="true">About</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="about-student">
                                        <div class="tab-content profile-tab" id="myTabContent">
                                            <div class="tab-pane fade active show" id="inforStudent" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Shop description</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                        if (!empty($rowShop["shop_description"])) {
                                                        ?>
                                                            <p><?= $rowShop["shop_description"] ?></p>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <p>Null</p>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Shop address</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                        if (!empty($rowShop["shop_address"])) {
                                                        ?>
                                                            <p><?= $rowShop["shop_address"] ?></p>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <p>Null</p>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Shop create time</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                        if (!empty($rowShop["shop_create_time"])) {
                                                        ?>
                                                            <p><?= date("Y/m/d H:i:s", $rowShop["shop_create_time"]); ?></p>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <p>Null</p>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Shop update time</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                        if (!empty($rowShop['shop_update_time'] == 0)) {

                                                        ?>
                                                            <td style="padding: 2.5%;">Not Update</td>

                                                        <?php
                                                        } else {  ?>
                                                            <td style="padding: 2.5%;">
                                                                <?php echo date("Y/m/d  H:i:s", $rowShop["shop_update_time"]); ?>
                                                            </td>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Shop status</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                        if (!empty($rowShop['shop_status'] == 1)) {
                                                        ?>

                                                            <p><button type="button" class="btn btn-primary">Active</button>
                                                            </p>

                                                        <?php
                                                        } elseif (!empty($rowShop['shop_status'] == 2)) {  ?>
                                                            <p><button type="button" class="btn btn-danger">Block</button>
                                                            </p>
                                                        <?php
                                                        }



                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Shop rank</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if (!empty($rowShop['shop_rank'] == 1)) {
                                                    ?>

                                                        <td><button type="button" class="btn btn-info">Silver</button></td>

                                                    <?php
                                                    } elseif (!empty($rowShop['shop_rank'] == 2)) {  ?>
                                                        <td><button type="button" class="btn btn-warning">Gold</button></td>
                                                    <?php
                                                    } elseif (!empty($rowShop['shop_rank'] == 3)) {  ?>
                                                        <td><button type="button" class="btn btn-success">Platinum</button></td>
                                                    <?php
                                                    } elseif (!empty($rowShop['shop_rank'] == 4)) {  ?>
                                                        <td><button type="button" class="btn btn-danger">Diamond</button></td>
                                                    <?php
                                                    }



                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function(e) {
            let activeId = null;

            $(document).on('click', '.btn-update-shop', function(e) {
                e.preventDefault();
                const shopId = parseInt($(this).data("id"));
                activeId = shopId;
                console.log(shopId);
                Utils.api("get_shop_info", {
                    id: shopId
                }).then(shop => {
                    $("input#shopId").val(shop.data.shop_id)
                    $("input#updateName").val(shop.data.shop_name)
                    $("#updateDescription").val(shop.data.shop_description)
                    $("#updateAddress").val(shop.data.shop_address)
                    $("#displayAvatarEdit").val(shop.data.shop_avatar)
                    // $("#updateRankShop").val(shop.data.shop_rank)
                    $('#updateShopProfile').modal();
                }).catch(err => {

                });
            });
        })
    </script>
</body>

</html>
<?php

if (isset($_POST["btnUpdateShopProfile"])) {

    $shopTimeUpdate = time();
    $updateImg = "";
    $id = $_POST['shopId'];

    // File upload configuration 
    $tm = md5(time());
    $statusMsg = '';
    $uploadPath = "./image_shop/";
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    $fileName =  basename($_FILES['updateAvatar']['name']);
    $fileUp =  $tm . $fileName;
    if (!empty($fileName)) {
        $updateImg  = $fileUp;

        $targetFilePath = $uploadPath . $updateImg;
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        // Check whether file type is valid 
        // var_dump("--------------------------------------", $updateImg);
        // exit;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (!empty($updateImg)) {
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["updateAvatar"]["tmp_name"], $targetFilePath)) {
                    $updateShopProfile = $link->query("UPDATE `shop` SET `shop_name`= '$_POST[updateName]' , `shop_description`= '$_POST[updateDescription]', `shop_address`= '$_POST[updateAddress]', `shop_avatar`= '$updateImg' , `shop_update_time`= $shopTimeUpdate WHERE `shop_id`= '$id' ");
                }
                if ($updateShopProfile == true) {
?>
                    <script type="text/javascript">
                        swal("Notice", $statusMsg, "success").then(function(e) {
                            location.replace("./index.php");
                        });
                    </script>
<?php
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }
    } else {
        $updateImg = $rowShop["shop_avatar"];
        $updateShopProfile = $link->query("UPDATE `shop` SET `shop_name`= '$_POST[updateName]' , `shop_description`= '$_POST[updateDescription]', `shop_address`= '$_POST[updateAddress]', `shop_avatar`= '$updateImg' , `shop_update_time`= $shopTimeUpdate WHERE `shop_id`= '$id' ");
    }
}

?>