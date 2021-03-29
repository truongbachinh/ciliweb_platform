<?php
include "../config.php";

?>

<?php

if (isset($_POST["addUser"])) {

    $count = 0;

    $result = $link->query("SELECT * from `role` where `role_name` ='$_POST[nameRole]'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {
?>
        <script type="text/javascript">
            alert("error")
        </script>
    <?php
    } else {
        $sqlAddRole = $link->query("INSERT INTO `role` (`role_id`, `role_name`, `role_description`, `role_status`, `role_create_time`) VALUES (NULL,'$_POST[nameRole]', '$_POST[descriptionRole]','1','" . time() . "')");
    ?>
        <script type="text/javascript">
            alert("addOKe")
        </script>
<?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->

        <section class="manage-topic">
            <div class="container-fluid m-t-30">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4> Manage User </h4>
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
                                        <a href="" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#addRole"><i class="mdi mdi-clipboard-plus"></i> Add neu user
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive p-t-10">
                                    <table class="table table-responsive  table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th scope="col">Id</th>
                                                <th scope="col">Full name</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Createa time</th>
                                                <th scope="col">Update time</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $res = mysqli_query($link, "select * from user");
                                            while ($row = mysqli_fetch_array($res)) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row["fullname"]; ?></td>
                                                    <td><?= $row["username"]; ?></td>
                                                    <td><?= $row["password"]; ?></td>
                                                    <td><?= $row["email"]; ?></td>
                                                    <?php
                                                    if (!empty($row['user_status'] == 1)) {
                                                    ?>

                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-primary">Active</button></td>

                                                    <?php
                                                    } elseif (!empty($row['user_status'] == 2)) {  ?>
                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-danger">Block</button></td>
                                                    <?php
                                                    }



                                                    ?>
                                                    <?php
                                                    if (!empty($row['user_role_id'] == 1)) {
                                                    ?>

                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-info">Shop</button></td>

                                                    <?php
                                                    } elseif (!empty($row['user_role_id'] == 2)) {  ?>
                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-warning">User</button></td>
                                                    <?php
                                                    }



                                                    ?>
                                                    <td><?= date("Y-m-d H:i:s", $row["user_create_time"]); ?></td>
                                                    <?php
                                                    if (!empty($row['user_update_time'] == 0)) {

                                                    ?>
                                                        <td>Not Update</td>

                                                    <?php
                                                    } else {  ?>
                                                        <td><?php echo date("Y-m-d  H:i:s", $row["user_update_time"]); ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" class="btn btn-info  btn-edit-role" role="button" data-id="<?= $row['role_id'] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="" class="btn btn-danger btn-delete-role" role="button" data-id="<?= $row['role_id'] ?>"><i class="mdi mdi-delete"></i>
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
                                <h5 class="modal-title" id="addRole">Add user</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" action="" method="post">
                                    <h6 style="padding-top: 2% !important;">Fullname</h6>
                                    <div class="form-group ">
                                        <input type="text" class="form-control" id="fullname" name="fullname">
                                    </div>
                                    <h6 style="padding-top: 2% !important;">Username</h6>
                                    <div class="form-group ">

                                        <input type="text" class="form-control" id="username" name="username">
                                    </div>
                                    <h6>Email</h6>
                                    <div class="form-group ">

                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                    <h6 style="padding-top: 2% !important;">Password</h6>
                                    <div class="form-group last mb-3">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <br>
                                    <div class="control-group">
                                        <label>Roles</label>
                                        <select class="form-group" name="role" require>
                                            <option selected value="student">--select role--</option>
                                            <option value="1">Shop-account</option>
                                            <option value="2">User-account</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="alert alert-success" id="success" style="margin-top: 10px; display: none">
                                        <strong>Success!</strong> Account Registration Successfully.
                                    </div>
                                    <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
                                        <strong>Already exist!</strong> The Username Alreadly Exits!
                                    </div>
                                    <input type="submit" value="Register" name="register" class="btn btn-block btn-success">

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






<?php
// session_start();
include "../connect_db.php";
?>