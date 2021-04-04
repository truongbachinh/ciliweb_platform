<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
?>

<?php

if (isset($_POST["addCategories"])) {
    $count = 0;
    $sql_user = "SELECT * from categories where ctg_name ='$_POST[nameCategories]'";
    $res = mysqli_query($link, $sql_user) or die(mysqli_error($link));
    $count = mysqli_num_rows($res);

    if ($count > 0) {
?>
        <script type="text/javascript">
            alert("Categories exits !");
            window.location.replace("./manage_categories.php");
        </script>
        <?php
    } else {

        // File upload configuration 
        $tm = md5(time());
        $statusMsg = '';
        $uploadPath = "./image_categories/";
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fileName =  $tm . basename($_FILES['imageCategories']['name']);
        $targetFilePath = $uploadPath . $fileName;
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        // Check whether file type is valid 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (!empty($fileName)) {

            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["imageCategories"]["tmp_name"], $targetFilePath)) {
                    $addCategories = $link->query("INSERT INTO `categories` (`ctg_id`,`ctg_name`,`ctg_description`, `ctg_image`,  `ctg_status`,  `ctg_create_time`) VALUES(NULL,'$_POST[nameCategories]','$_POST[descriptionCategories]','$fileName','1','" . time() . "')");
                }
                if ($addCategories) {
        ?>
                    <script type="text/javascript">
                        alert("add categories success !");
                        window.location.replace("./manage_categories.php");
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

        <section class="manage-topic">
            <div class="container m-t-30">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4> Manage order </h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group has-search">
                                            <span class="fa fa-search form-control-feedback"></span>
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <a href="" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#addRole"><i class="mdi mdi-clipboard-plus"></i> Add new order
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive p-t-10">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Order Id</th>
                                                <th>User name</th>
                                                <th>Fullname</th>
                                                <th> phone</th>
                                                <th>Address</th>
                                                <th>Total</th>
                                                <th>Quantity</th>
                                                <th>Payment status</th>
                                                <th>View Detail</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $res = $link->query("SELECT orders.*,user.*,order_address.* from orders INNER JOIN order_address ON orders.id = order_address.oda_order_id INNER JOIN user ON user.user_id = orders.order_user_id where order_shop_id  = $shopId ");
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($res)) {

                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $row['username'] ?></td>
                                                    <td><?= $row['oda_firstname'], " ", $row['oda_lastname'] ?></td>
                                                    <td><?= $row['oda_address'] ?></td>
                                                    <td><?= $row['oda_address_2'] ?></td>
                                                    <td><?= $row['order_total_cost'] ?></td>
                                                    <td><?= $row['order_total_amount'] ?></td>
                                                    <td>NOT YET</td>
                                                    <td><a href="bill.php?id=<?= $row["id"] ?>&idu=<?= $row["order_user_id"] ?>">Show Detail</a></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="bill.php?id=<?= $row["id"] ?>&idu=<?= $row["order_user_id"] ?>" class="btn btn-info  btn-edit-role" role="button" data-id="<?= $row['role_id'] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="bill.php?id=<?= $row["id"]; ?>" class="btn btn-danger btn-delete-role" role="button" data-id="<?= $row['role_id'] ?>"><i class="mdi mdi-delete"></i>
                                                            </a>
                                                            <a href="" class="btn btn-primary  btn-get-role-info" role="button" data-id="<?= $row['role_id'] ?>"><i class="mdi mdi-dots-horizontal"></i> </a>
                                                        </div>
                                                    </td>


                                                </tr>
                                            <?php

                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal add role -->
                <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="addRole" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addRole">Add categories</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" name="manageCategories" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label">Categories Name :</label>
                                        <input type="text" class="form-control" id="nameCategories" name="nameCategories" placeholder="Enter name of categories" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Categories Description :</label>
                                        <input type="text" class="form-control" id="descriptionCategories" name="descriptionCategories" placeholder="Enter name of topic" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Categories Image :</label>
                                        <input type="file" class="p11" class="form-control" id="imageCategories" name="imageCategories" placeholder="Enter name of topic" required>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-md float-right" name="addCategories" value="Create categories">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Detail -->
                <div class="modal fade" id="roleDetailModal" tabindex="-1" role="dialog" aria-labelledby="detailRole" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailRole">Detail order
                                    Information
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="detail">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Order Id</td>
                                                <td id="roleNameDetail"></td>
                                            </tr>
                                            <tr>
                                                <td>Người nhận</td>
                                                <td id="roleDescriptionDetail"></td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td id="roleStatusDetail"></td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td id="roleCreateTime"></td>
                                            </tr>
                                            <tr>
                                                <td>Sản phẩm</td>
                                                <td id="roleUpdateTime"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="button-close float-right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editTopic" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTopic">Edit User Information</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="create-account-form">
                                    <div class="form-group">
                                        <label for="inp-username">Username</label>
                                        <input type="text" class="form-control" id="inp-username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-fullname">Full Name</label>
                                        <input type="text" class="form-control" id="inp-fullname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-email">Email</label>
                                        <input type="text" class="form-control" id="inp-email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-status">Status</label>
                                        <select id="inp-status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Blocked</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-role">Role</label>
                                        <select id="inp-role" class="form-control">
                                            <option value="student">Student</option>
                                            <option value="admin">Admin</option>
                                            <option value="manager-coordinator">Coordinator Manager</option>
                                            <option value="manager-marketing">Marketing Manager</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inp-password">New Password (Leave blank for unchanged)</label>
                                        <input type="password" placeholder="Leave blank for unchanged..." class="form-control" id="inp-password" required>
                                    </div>

                                    <div class="model-footer">
                                        <button type="button" class="btn btn-warning btn-save">
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
        </section>
        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {
            let activeId = null;
            $(document).on('click', ".btn-add-role", function(e) {
                Utils.api("add_role_info", {
                    roleName: $('#addNameRole').val(),
                    roleDescription: $('#addDescriptionRole').val(),
                }).then(response => {



                }).catch(err => {

                })
            });
            $(document).on('click', ".btn-get-role-info", function(e) {
                e.preventDefault();
                $('#roleDetailModal').modal();
                const roleId = parseInt($(this).data("id"));
                activeId = roleId;
                console.log(roleId);
                Utils.api("get_role_info", {
                    id: roleId
                }).then(response => {
                    console.log("name", response.data.role_name);
                    $('#roleNameDetail').text(response.data.role_name);
                    $('#roleDescription').text(response.data.role_description);
                    $('#roelStatus').texy(response.data.role_status);
                    $('#roelCreateTime').text(response.data.role_create_time);
                    $('#roelUpdateTime').text(response.data.topic_update_time);
                    $('#roleDetailModal').modal();
                }).catch(err => {

                })
            });
        })
    </script>
</body>

</html>