<?php
include "../config.php";
$pPerPage = !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
$currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
$offest = ($currentPage - 1) * $pPerPage;
$countRole = mysqli_query($link, "SELECT * from role");
$res = mysqli_query($link, "SELECT * from `role`  order by `role_id` ASC LIMIT " . $pPerPage . " OFFSET " . $offest . "");
$totalRole = $countRole->num_rows;
$totalPage = ceil($totalRole / $pPerPage);
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
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4> Manage Role </h4>
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
                                        <a href="" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#addRole"><i class="mdi mdi-clipboard-plus"></i> Add Role
                                        </a>
                                    </div>
                                </div>
                                <?php
                                include('../pagination/pagination.php');
                                ?>
                                <div class="table-responsive p-t-10">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Id</th>
                                                <th>Role name</th>
                                                <th>Role description</th>
                                                <th>Role status</th>
                                                <th>Create time</th>
                                                <th>Update time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;

                                            while ($row = mysqli_fetch_array($res)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row["role_name"]; ?></td>
                                                    <td><?php echo $row["role_description"]; ?></td>
                                                    <?php
                                                    if (!empty($row['role_status'] == 1)) {
                                                    ?>

                                                        <td style="padding: 1.5%;"><button style="border-radius: 10px" type="button" class="btn btn-primary">Active</button></td>

                                                    <?php
                                                    } else {  ?>
                                                        <td style="padding: 1.5%;"><button style="border-radius: 10px" type="button" class="btn btn-danger">Block</button></td>
                                                    <?php
                                                    }



                                                    ?>
                                                    <td><?php echo date("Y/m/d H:i:s", $row["role_create_time"]); ?></td>
                                                    <?php
                                                    if (!empty($row['role_update_time'] == 0)) {

                                                    ?>
                                                        <td style="padding: 2.5%;">Not Update</td>

                                                    <?php
                                                    } else {  ?>
                                                        <td style="padding: 2.5%;"><?php echo date("Y/m/d  H:i:s", $row["role_update_time"]); ?></td>
                                                    <?php
                                                    }
                                                    ?>


                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" class="btn btn-info  btn-edit-role  d-flex justify-content-between" role="button" data-id="<?= $row['role_id'] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="" class="btn btn-danger btn-delete-role d-flex justify-content-between" role="button" data-id="<?= $row['role_id'] ?>"><i class="mdi mdi-delete"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                include('../pagination/pagination.php');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal add role -->
                <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="addRole" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addRole">Add Role</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" name="postRole">
                                    <div class="form-group">
                                        <label class="control-label">Role Name :</label>
                                        <input type="text" class="form-control" id="addNameRole" name="nameRole" placeholder="Enter name of role" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Role Description :</label>
                                        <input type="text" class="form-control" id="addDescriptionRole" name="descriptionRole" placeholder="Enter description role" required>
                                    </div>
                                    <input type="submit" name="addRole" class="btn btn-primary btn-md float-right btn-add-role" value="Create role">
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
                <!-- Modal Edit -->
                <div class="modal fade" id="editRole" tabindex="-1" role="dialog" aria-labelledby="editRole" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editRole">Edit Role Information</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="create-account-form">
                                    <div class="form-group">
                                        <label for="editRoleKey">Role key</label>
                                        <input type="text" class="form-control" id="editRoleKey" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editRoleName">Role name</label>
                                        <input type="text" class="form-control" id="editRoleName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editRoleDescription">Role Description</label>
                                        <input type="text" class="form-control" id="editRoleDescription" required>
                                    </div>
                                    <div class="form-group statusRole">
                                        <label for="editRoleStatus">Role Status</label>
                                        <select id="editRoleStatus" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Blocked</option>
                                        </select>
                                    </div>
                                    <div class="model-footer">
                                        <button type="button" class="btn btn-warning btn-update-role">
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

            $(document).on('click', ".btn-delete-role", function(e) {
                e.preventDefault();
                swal({
                    title: "Please confirm",
                    text: 'Are sure you want to delete this role?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        Utils.api('delete_role_info', {
                            id: $(this).data('id'),
                        }).then(response => {
                            swal("Notice", response.msg, "success")
                            location.reload();

                        }).catch(err => {})
                    }
                });
            });
            $(document).on('click', '.btn-edit-role', function(e) {
                e.preventDefault();
                const roleId = parseInt($(this).data("id"));
                activeId = roleId;
                console.log(roleId);
                Utils.api("get_role_info", {
                    id: roleId
                }).then(role => {
                    $("input#editRoleKey").val(role.data.role_id)
                    $("#editRoleName").val(role.data.role_name)
                    $("#editRoleDescription").val(role.data.role_description)
                    $("#editRoleStatus ").val(role.data.role_status)
                    $('#editRole').modal();
                }).catch(err => {

                });
            });
            $(document).on('click', '.btn-update-role', function(e) {
                Utils.api("update_role_info", {
                    id: activeId,
                    editRoleName: $("#editRoleName").val(),
                    editRoleDescription: $("#editRoleDescription").val(),
                    editRoleStatus: $("#editRoleStatus").val(),
                }).then(response => {
                    $("#editRole").modal("hide");
                    swal("Notice", "Record is updated successfully!", "success").then(function(e) {
                        location.reload()
                    });
                }).catch(err => {

                })
            });
        })
    </script>
</body>

</html>


<?php

if (isset($_POST["addRole"])) {

    $count = 0;

    $result = $link->query("SELECT * from `role` where `role_name` ='$_POST[nameRole]'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {
?>
        <script type="text/javascript">
            alert("error");
        </script>
    <?php
    } else {
        $sqlAddRole = $link->query("INSERT INTO `role` (`role_id`, `role_name`, `role_description`, `role_status`, `role_create_time`) VALUES (NULL,'$_POST[nameRole]', '$_POST[descriptionRole]','1','" . time() . "')");
    ?>
        <script type="text/javascript">
            swal("Notice", "Add successfully!", "success");
        </script>
<?php
    }
}

?>