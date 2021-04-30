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
                                <div class="text text-center m-b-5"><?= (!empty($rowUser) ? ($rowUser["ui_lastname"]) : "Null") ?></div>
                            </h4>
                        </div>
                        <!-- Modal edit profile -->
                        <div class="row justify-content-end p-r-40">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Edit profile
                            </button>
                            <!-- Model edit -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit profile
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" name="formAddInfor" id="addUserInfor" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="inputFirstName">First name</label>
                                                    <input type="text" class="form-control" id="inputFirstName" name="firstName">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputLastName">Last name</label>
                                                    <input type="text" class="form-control" id="inputLastName" name="lastName">
                                                </div>
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
                                                <input type="submit" class="btn btn-primary" name="addProfileUser" value="Save changes">
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
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
                firstName: {
                    required: true,
                    lettersOnly: true,
                },
                lastName: {
                    required: true,
                    lettersOnly: true,
                },
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
                firstName: {
                    required: "Please provide last name!",
                    lettersOnly: "Please provide only character in alphabet!",
                },
                lastName: {
                    required: "Please provide first name!",
                    lettersOnly: "Please provide only character in alphabet!",
                },
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
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $fileName =  $tm . basename($_FILES['avatarUser']['name']);
    $targetFilePath = $uploadPath . $fileName;

    // Check whether file type is valid 

    if (!empty($fileName)) {
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
            $check = true;
            $up = move_uploaded_file($_FILES["avatarUser"]["tmp_name"], $targetFilePath);
        } else {

?>
            <script>
                swal("Notice", 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.', "warning");
            </script>
        <?php
        }
    }
    $result = $link->query("SELECT * from `user_infor` where `ui_user_id` = '$userId'");
    $count = mysqli_num_rows($result);


    if ($check == true && $up == true) {
        if ($count > 0) {
            $deleteUserInfor =  $link->query("DELETE  from user_infor  where `ui_user_id` = '$userId'");
        }
        $addUserInfor = $link->query("INSERT INTO `user_infor` (`ui_id_infor`, `ui_avatar`, `ui_firstname`, `ui_lastname`, `ui_address`, `ui_DOB`, `ui_phone`, `ui_create_time`, `ui_user_id`) VALUES (NULL,'$fileName','$_POST[firstName]','$_POST[lastName]','$_POST[address]','$_POST[DoB]','$_POST[phone]','" . $timeInVietNam . "','$userId')");
        if ($addUserInfor) {
        ?>
            <script type="text/javascript">
                swal("Notice", 'Adding user information success !', "success");
                setTimeout(window.location.replace("./index.php?view=profile&id=<?= $userId ?>"), 500);
            </script>
        <?php
        } else {

        ?>
            <script type="text/javascript">
                swal("Notice", 'Adding user information False !', "warning");
                window.location.replace("./index.php?view=profile&id=<?= $userId ?>");
            </script>
        <?php
        }
    } else {
        if ($count > 0) {
            $deleteUserInfor =  $link->query("DELETE  from user_infor  where `ui_user_id` = '$userId'");
        }
        $addUserInfor = $link->query("INSERT INTO `user_infor` (`ui_id_infor`,`ui_avatar`,  `ui_firstname`, `ui_lastname`, `ui_address`, `ui_DOB`, `ui_phone`, `ui_create_time`, `ui_user_id`) VALUES (NULL,'$rowUser[ui_avatar]','$_POST[firstName]','$_POST[lastName]','$_POST[address]','$_POST[DoB]','$_POST[phone]','" . $timeInVietNam . "','$userId')");
        if ($addUserInfor) {
        ?>
            <script type="text/javascript">
                swal("Notice", 'Adding user information successfully !', "success");
                setTimeout(window.location.replace("./index.php?view=profile&id=<?= $userId ?>"), 500);
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                swal("Notice", 'Adding user information False !', "warning");
                window.location.replace("./index.php?view=profile&id=<?= $userId ?>");
            </script>
<?php
        }
    }
}

?>