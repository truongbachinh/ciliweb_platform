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
                                                <form action="" name="forml" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="studentId">Student ID</label>
                                                        <input type="text" class="form-control" id="inputStudentId" name="idStudent">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="studentName">Name Student</label>
                                                        <input type="text" class="form-control" id="inputStudentName" name="nameStudent">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputAddress">Address</label>
                                                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPhone">Phone</label>
                                                        <input type="text" class="form-control" id="inputPhone" name="phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPhone">Email</label>
                                                        <input type="text" class="form-control" id="inputEmail" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPhone">DOB</label>
                                                        <input type="date" class="form-control" id="inputDoB" name="DoB">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPhone">Major</label>
                                                        <input type="text" class="form-control" id="inputMajor" name="major">
                                                    </div>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <input type="submit" class="btn btn-primary" name="updateProfile" value="Save changes">
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
                                                            <td style="padding: 2.5%;"><?php echo date("Y/m/d  H:i:s", $row["shop_update_time"]); ?></td>
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

                                                            <p><button type="button" class="btn btn-primary">Active</button></p>

                                                        <?php
                                                        } elseif (!empty($rowShop['shop_status'] == 2)) {  ?>
                                                            <p><button type="button" class="btn btn-danger">Block</button></p>
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
        })
    </script>
</body>

</html>
<?php
if (isset($_POST["updateProfile"])) {

    if ($rowInfor == NULL) {

        $addInfor = mysqli_query($conn, "INSERT INTO `user_infor` (`user_id`, `id_card`, `name`, `address`, `phone`,`email`, `DOB`, `major`) VALUES ('$userId', '$_POST[idStudent]', '$_POST[nameStudent]', '$_POST[address]', '$_POST[phone]','$_POST[email]', '$_POST[DoB]', '$_POST[major]');");
    } else {
        $updateInfor = mysqli_query($conn, "update `user_infor` set `user_id` = '$userId' , `id_card`  = '$_POST[idStudent]', `name`  = '$_POST[nameStudent]', `address`  = '$_POST[address]', `phone`  = '$_POST[phone]',`email`  = '$_POST[email]', `DOB`  = '$_POST[DoB]', `major` = '$_POST[major]';");
    }



    if ($updateInfor == true) {
?>
        <script type="text/javascript">
            alert("update Infor successful");
            window.location.replace("./profile.php");
        </script>
    <?php
    } elseif ($addInfor == true) {
    ?>
        <script type="text/javascript">
            alert("add Infor successful");
            window.location.replace("./profile.php");
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            window.location = "./homepage.php"
        </script>
<?php
    }
}
?>