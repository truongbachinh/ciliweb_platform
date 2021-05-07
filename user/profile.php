<?php
include "../config_user.php";
?>
<section class="admin-content" style="margin-top:80px">
    <div class="container m-t-30" id="myInformation">
        <div class="row justify-content-md-center">
            <div class="col-lg-11 m-l-70">
                <div class="card m-b-30">
                    <div class="card-media">
                        <img class="card-img-top " src="../images/ciliweb.png" height="250" style="border-radius:5px" alt="banner">
                    </div>
                    <div class="card-body">
                        <div class="text-center pull-up-sm">
                            <div class="avatar avatar-xxl">
                                <?php
                                if ($resultUserInfor->num_rows > 0) {
                                    $imageURL = '../user/avatar/' . $rowUser["ui_avatar"];
                                ?>
                                    <img class="avatar-img rounded-circle" src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                <?php
                                } else { ?>
                                    <img class="avatar-img rounded-circle" src="../images/ciliweb.png" alt="" height="50" width="50" style="border-radius:10px" />
                                    <p>Defaul avatar</p>
                                <?php } ?>
                            </div>
                            <h4 class="text-center m-t-20">
                                <div class="text text-center m-b-5"><?= (!empty($rowUser) ? ($rowUser["fullname"]) : "Null") ?></div>
                            </h4>
                        </div>
                        <!-- Modal edit profile -->
                        <?php
                        if (empty($rowUser["ui_avatar"])) {
                        ?>
                            <div class="row justify-content-end p-r-40">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUserInfor">
                                    Add detail profile
                                </button>
                                <!-- Model edit -->
                                <div class="modal fade" id="addUserInfor" tabindex="-1" role="dialog" aria-labelledby="addUserInfor" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addUserInfor">Add profile
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" name="formAddInfor" id="addUserInfor" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="inputPhone">Phone</label>
                                                        <input type="text" class="form-control" id="inputPhone" name="phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputAddress">Address</label>
                                                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPhone">DOB</label>
                                                        <input type="date" class="form-control" id="inputDoB" name="DoB">
                                                    </div>
                                                    <div class="form-group">
                                                        <div>
                                                            <p class=" font-secondary">Avatar Uploads</p>
                                                            <div class="input-group mb-3">
                                                                <div onload="GetFileInfo ()">
                                                                    <input type="file" class="custom-file-input" id="inputFile" name="avatarUser" onchange="GetFileInfo ()">
                                                                    <label class="custom-file-label" for="inputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                            <div id="info" style="margin-top:10px"></div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <input type="submit" class="btn btn-primary " name="addProfileUser" value="Save changes">
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="row justify-content-end p-r-40">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" onclick="editUserInfor(<?= $userId ?>)" data-target="#editUserInfor">
                                    Edit profile
                                </button>
                                <!-- Model edit -->
                                <div class="modal fade" id="editUserInfor" tabindex="-1" role="dialog" aria-labelledby="editUserInfor" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editUserInfor">Edit profile
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" name="formEditInfor" id="editUserInfor" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="updateFullName">Full name</label>
                                                        <input type="text" class="form-control" id="updateFullName" name="updateFullName">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="updateLastName">Email</label>
                                                        <input type="text" class="form-control" id="updateEmail" name="updateEmail">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="updatePhone">Phone</label>
                                                        <input type="text" class="form-control" id="updatePhone" name="updatePhone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="updateAddress">Address</label>
                                                        <input type="text" class="form-control" id="updateAddress" name="updateAddress">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="updatePhone">DOB</label>
                                                        <input type="date" class="form-control" id="updateDoB" name="updateDoB">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputFile">User avatar</label>
                                                        <img src="<?php echo $imageURL; ?>" alt="" width="50" height="50" style="display: flex; flex-direction:row; margin:10px 20px" />
                                                        <div>
                                                            <p class=" font-secondary">Avatar Uploads</p>
                                                            <div class="input-group mb-3">
                                                                <div onload="GetFileInfo ()">
                                                                    <input type="file" class="custom-file-input" id="inputFile" name="editAvatarUser" onchange="GetFileInfo ()">
                                                                    <label class="custom-file-label" for="inputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                            <div id="info" style="margin-top:10px"></div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <input type="submit" class="btn btn-primary btn-edit-user-infor-detail" name="updateProfileUser" value="Save changes">
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="row justify-content-md-center">
                            <div class="col-md-9">
                                <div class="tab-infor m-b-15">
                                    <ul class="nav nav-tabs" id="myTabInforUser" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="home-tab" data-toggle="tab" style="background: yellowgreen;" href="#inforUser" role="tab" aria-controls="home" aria-selected="true">About</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="about-student">
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade active show" id="inforUser" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if (!empty($rowUser["email"])) {
                                                    ?>
                                                        <p><?= $rowUser["email"] ?></p>
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
                                                    <label>User phone</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if (!empty($rowUser["ui_phone"])) {
                                                    ?>
                                                        <p><?= $rowUser["ui_phone"] ?></p>
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
                                                    <label>User address</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if (!empty($rowUser["ui_address"])) {
                                                    ?>
                                                        <p><?= $rowUser["ui_address"] ?></p>
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
                                                    <label>User Date of Birth</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if (!empty($rowUser["ui_DOB"])) {
                                                    ?>
                                                        <p><?= date("Y-M-d",  strtotime($rowUser["ui_DOB"])) ?></p>
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
                                                    <label>User information create time</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if (!empty($rowUser["ui_create_time"])) {
                                                    ?>
                                                        <p><?= date("Y-M-d H:i:s", strtotime($rowUser["ui_create_time"])); ?></p>
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
                                                    <label>User status</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if ((!empty($rowUser['user_status'])) && $rowUser['user_status'] == 1) {
                                                    ?>

                                                        <p><button type="button" class="btn btn-primary">Active</button></p>

                                                    <?php
                                                    } elseif ((!empty($rowUser['user_status'])) && $rowUser['user_status']  == 2) {  ?>
                                                        <p><button type="button" class="btn btn-danger">Block</button></p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p>Null</p>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("validDate", function(value, element) {
            return this.optional(element) || moment(value, "DD/MM/YYYY").isValid();
        }, "Please enter a valid date in the format DD/MM/YYYY");

        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "Value must not equal arg.");

        $.validator.addMethod("lettersOnly", function(value, element) {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        }, "Letters and spaces only please");
        $('#addUserInfor').validate({
            rules: {
                phone: {
                    required: true,
                    number: true,
                },
                address: {
                    required: true,
                },
                DoB: {
                    required: true,
                }
            },
            messages: {
                phone: {
                    required: "Please provide your number phone!",
                    number: "Please provide number phone!",
                },
                address: {
                    required: "Please provide your address!",
                },
                DoB: {
                    required: "Please provide your DOB!",
                },

            },
        })
    })
</script>


<?php
if (isset($_POST["addProfileUser"])) {
    $check = false;
    $upload_query = false;
    $targetFilePath = "";
    $fileType = "";
    $tm = md5(time());
    $uploadPath = "./avatar/";
    $allowTypes = array('jpg', 'JPG', 'PNG', 'png', 'jpeg', 'gif');

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $fileName =  $tm . basename($_FILES['avatarUser']['name']);
    $targetFilePath = $uploadPath . $fileName;

    // Check whether file type is valid 

    if (!empty($fileName)) {
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {

            $up = move_uploaded_file($_FILES["avatarUser"]["tmp_name"], $targetFilePath);
        } else {
?>
            <script>
                swal("Notice", 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.', "warning");
            </script>
        <?php
        }
    }

    if ($up == true) {

        $addUserInfor = $link->query("INSERT INTO `user_infor` (`ui_id_infor`, `ui_avatar`, `ui_address`, `ui_DOB`, `ui_phone`, `ui_create_time`, `ui_user_id`) VALUES (NULL,'$fileName','$_POST[address]','$_POST[DoB]','$_POST[phone]','" . $timeInVietNam . "','$userId')");
        if ($addUserInfor) {
        ?>
            <script type="text/javascript">
                swal("Notice", 'Adding user information success !', "success");
                location.reload();
            </script>
        <?php
        } else {

        ?>
            <script type="text/javascript">
                swal("Notice", 'Adding user information False !', "warning");
                location.reload();
            </script>
            <?php
        }
    }
}
if (isset($_POST["updateProfileUser"])) {


    $updateUserInfor = $link->query("UPDATE `user` SET `email` = '$_POST[updateEmail]' , `fullname` = '$_POST[updateFullName]', `user_update_time` = '$timeInVietNam' WHERE `user_id`= '$userId' ");

    // File upload configuration 
    $check = false;
    $upload_query = false;
    $targetFilePath = "";
    $fileType = "";
    $tm = md5(time());
    $uploadPath = "./avatar/";
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    $allowTypes = array('jpg', 'JPG', 'PNG', 'png', 'jpeg', 'gif');

    $shopTimeUpdate = time();
    $updateImg = "";
    $updateUserProfile = "";



    $fileName =  basename($_FILES['editAvatarUser']['name']);
    $fileUp =  $tm . $fileName;

    if (!empty($fileName)) {
        $updateImg  = $fileUp;
        $targetFilePath = $uploadPath . $updateImg;
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (!empty($updateImg)) {
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array(strtolower($fileType), $allowTypes)) {
                if (move_uploaded_file($_FILES["editAvatarUser"]["tmp_name"], $targetFilePath)) {
                    $updateUserProfile = $link->query("UPDATE `user_infor` SET `ui_phone`= '$_POST[updatePhone]' , `ui_address`= '$_POST[updateAddress]', `ui_address`= '$_POST[updateAddress]', `ui_avatar`= '$updateImg',`ui_DOB` = '$_POST[updateDoB]' , `ui_update_time`= '$timeInVietNam' WHERE `ui_user_id`= '$userId' ");
                }
            } else {
            ?>
                <script>
                    alert("Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.");
                </script>
            <?php

            }
        } else {
            ?>
            <script>
                alert("Please select a file to upload.");
            </script>
        <?php

        }
    } else {
        $updateImg = $rowUser["ui_avatar"];
        $updateUserProfile = $link->query("UPDATE `user_infor` SET `ui_phone`= '$_POST[updatePhone]' , `ui_address`= '$_POST[updateAddress]', `ui_DOB`= '$_POST[updateDoB]', `ui_avatar`= '$updateImg' , `ui_update_time`= '$timeInVietNam' WHERE `ui_user_id`= '$userId' ");
    }

    if ($updateUserProfile == true && $updateUserInfor == true) {
        ?>
        <script>
            alert("Update successfully");
            location.replace("./index.php?view=profile");
        </script>
<?php
    }
}

?>