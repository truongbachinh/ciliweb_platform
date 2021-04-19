<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
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
        <section class="manage-product">
            <div class="container m-t-30">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4> Select categories </h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group has-search">
                                            <span class="fa fa-search form-control-feedback"></span>
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </div>

                                </div> -->
                                <div class="table-responsive p-t-10">
                                    <table id="table_categories" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Id</th>
                                                <th>Categories name</th>
                                                <th>Categories description</th>
                                                <th>Categories image</th>
                                                <th>Categories status</th>

                                                <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $result = $link->query("select * from categories");
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row["ctg_name"]; ?></td>
                                                    <td><?= $row["ctg_description"]; ?></td>
                                                    <td><?php
                                                        if ($result->num_rows > 0) {
                                                            $imageURL = '../admin/image_categories/' . $row["ctg_image"];
                                                        ?>
                                                            <img src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                                        <?php
                                                        } else { ?>
                                                            <p>No image(s) found...</p>

                                                        <?php } ?>
                                                    </td>
                                                    <?php
                                                    if (!empty($row['ctg_status'] == 1)) {
                                                    ?>

                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-primary">Active</button></td>

                                                    <?php
                                                    } else {  ?>
                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-danger">Block</button></td>
                                                    <?php
                                                    }



                                                    ?>

                                                    <td>
                                                        <a href="./view_product_in_categories.php?idsh=<?= $shopId ?>&idctg=<?= $row["ctg_id"] ?>" class="btn btn-info  btn-edit-role" role="button">
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <i class="mdi mdi-pencil-outline"></i>
                                                            </div>
                                                        </a>
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
                                <h5 class="modal-title" id="detailRole">Detail
                                    Information role
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
                                                <td>Role Name</td>
                                                <td id="roleNameDetail"></td>
                                            </tr>
                                            <tr>
                                                <td>Role description</td>
                                                <td id="roleDescriptionDetail"></td>
                                            </tr>
                                            <tr>
                                                <td>Role status</td>
                                                <td id="roleStatusDetail"></td>
                                            </tr>
                                            <tr>
                                                <td>Role create time</td>
                                                <td id="roleCreateTime"></td>
                                            </tr>
                                            <tr>
                                                <td>Role update time</td>
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
        $(document).ready(function() {
            $('#table_categories').DataTable();
        })
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