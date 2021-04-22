<?php
include "../config_admin.php";
if (!isset($_SESSION['current_user'])) {
    header("location: ./account/login.php");
}
$pPerPage = !empty($_GET['per_page']) ? $_GET['per_page'] : 2;
$currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
$offest = ($currentPage - 1) * $pPerPage;
$countUser = mysqli_query($link, "SELECT * from user");
$res = mysqli_query($link, "SELECT * from user  order by `user_id` ASC LIMIT " . $pPerPage . " OFFSET " . $offest . "");
$totalUser = $countUser->num_rows;
$totalPage = ceil($totalUser / $pPerPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
    <link rel="stylesheet" href="./css/manage_user.css">
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
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive p-t-10">
                                    <table id="table_manage_user" class="table table-responsive center table-bordered table-striped">
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
                                                <!--  <th scope="col">Update time</th> -->
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($res)) {
                                            ?>
                                                <tr>
                                                    <td class="max-lines"><?= $i++; ?></td>
                                                    <td class="max-lines"><?= $row["fullname"]; ?></td>
                                                    <td class="max-lines"><?= $row["username"]; ?></td>
                                                    <td class="max-lines"><?= $row["password"]; ?></td>
                                                    <td class="max-lines"><?= $row["email"]; ?></td>
                                                    <?php
                                                    if (!empty($row['user_status'] == 1)) {
                                                    ?>

                                                        <td class="max-lines"><button style="border-radius: 10px" type="button" class="btn btn-primary">Active</button></td>

                                                    <?php
                                                    } elseif (!empty($row['user_status'] == 2)) {  ?>
                                                        <td class="max-lines"><button style="border-radius: 10px" type="button" class="btn btn-danger">Block</button></td>
                                                    <?php
                                                    }



                                                    ?>
                                                    <?php
                                                    if (!empty($row['user_role_id'] == 1)) {
                                                    ?>

                                                        <td class="max-lines"><button style="border-radius: 10px" type="button" class="btn btn-info">Shop</button></td>

                                                    <?php
                                                    } elseif (!empty($row['user_role_id'] == 2)) {  ?>
                                                        <td class="max-lines"><button style="border-radius: 10px" type="button" class="btn btn-warning">User</button></td>
                                                    <?php
                                                    }
                                                    ?>


                                                    <td><?=
                                                        date('d-M-Y  H:i:s', strtotime($row["user_create_time"]));
                                                        ?></td>
                                                    <!--     <?php
                                                                if (!empty($row['user_update_time'] == 0)) {

                                                                ?>
                                                        <td>Not Update</td>

                                                    <?php
                                                                } else {  ?>
                                                        <td><?php echo
                                                                    date('d-M-Y  H:i:s', strtotime($row["user_update_time"]));

                                                            ?></td>
                                                    <?php
                                                                }
                                                    ?> -->

                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" class="btn btn-info  btn-edit-user" role="button" data-id="<?php echo $row['user_id'] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="" class="btn btn-danger btn-delete-user" role="button" data-id="<?php echo $row['user_id'] ?>"><i class="mdi mdi-delete"></i></a>
                                                            <a href="" class="btn btn-primary  btn-detail-user" role="button" data-id="<?php echo $row['user_id'] ?>"><i class="mdi mdi-dots-horizontal"></i> </a>
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
                <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUser">Edit User Information</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="edit-account-form">
                                    <div class="form-group">
                                        <label for="editUsername">User Account</label>
                                        <input type="text" class="form-control" id="editUsername" readonly>
                                    </div>
                                    <div class="form-group statusUser">
                                        <label for="editStatus">User Status</label>
                                        <select id="editStatus" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Blocked</option>
                                        </select>
                                    </div>
                                    <div class="form-group roleUser">
                                        <label for="editRole">Role</label>
                                        <select id="editRole" class="form-control">
                                            <option value="1">Shop</option>
                                            <option value="2">User</option>
                                        </select>
                                    </div>
                                    <div class="model-footer">
                                        <button type="button" class="btn btn-warning btn-update-user">
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
                <div class="modal fade" id="detailUser" tabindex="-1" role="dialog" aria-labelledby="detailUser" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailUser">Detail Information Faculty
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-t-0 p-l-0 p-r-0">
                                <div class="detail">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Avatar</td>
                                                <td>

                                                    <div class="avatar avatar-sm avatar-online">

                                                        <img src="" class="avatar-img rounded-circle" alt="No avatar" id="detailAvatar">


                                                    </div>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Fullname</td>
                                                <td id="detailFullname"></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td id="detailUsername"></td>
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td id="detailPassword"></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td id="detailEmail">

                                                </td>
                                            </tr>
                                            <tr>


                                                <td>Phone</td>
                                                <td id="detailPhone"></td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td id="detailAddress"></td>


                                            </tr>
                                            <tr>
                                                <td>Create time</td>
                                                <td id="detailCreateTime">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Update time </td>
                                                <td id="detailUpdateTime">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="button-close float-right">
                                    <button type="button" class="btn btn-secondary m-r-10" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>

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
            $('#table_manage_user').DataTable();
        })
        document.addEventListener("DOMContentLoaded", function(e) {
            let activeId = null;
            $(document).on('click', ".btn-delete-user", function(e) {
                e.preventDefault();
                swal({
                    title: "Please confirm",
                    text: 'Are sure you want to delete this user?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        Utils.api('delete_user_info', {
                            id: $(this).data('id'),
                        }).then(response => {
                            swal("Notice", response.msg, "success").then(function(e) {
                                location.replace("./manage_user.php");
                            });
                        }).catch(err => {})
                    }
                });
            });
            $(document).on('click', '.btn-edit-user', function(e) {
                e.preventDefault();

                const userId = parseInt($(this).data("id"));
                activeId = userId;
                console.log(userId);
                Utils.api("get_user_info", {
                    id: userId
                }).then(user => {
                    $("input#editUsername ").val(user.data.username)
                    $("#editStatus ").val(user.data.user_status)
                    $("#editRole ").val(user.data.user_role_id)
                    $('#editUser').modal();
                }).catch(err => {

                });
            });
            $(document).on('click', '.btn-update-user', function(e) {
                Utils.api("update_user_info", {
                    id: activeId,
                    editStatus: $("#editStatus").val(),
                    editRole: $("#editRole").val(),
                }).then(response => {
                    $("#editUser").modal("hide");
                    swal("Notice", "Record is updated successfully!", "success").then(function(e) {
                        location.replace("./manage_user.php");
                    });
                }).catch(err => {

                })
            });
            $(document).on('click', '.btn-detail-user', function(e) {
                e.preventDefault();
                var pathFile = "../user/avatar/";
                const userId = parseInt($(this).data("id"));
                console.log(userId)
                Utils.api('get_user_info_detail', {
                    id: userId
                }).then(response => {
                    $('#detailAvatar').attr('src', pathFile.concat(response.data.ui_avatar));
                    $('#detailFullname').text(response.data.fullname);
                    $('#detailUsername').text(response.data.username);
                    $('#detailPassword').text(response.data.password);
                    $('#detailEmail').text(response.data.email);
                    $('#detailAddress').text(response.data.ui_address);
                    $('#detailPhone').text(response.data.ui_phone);
                    $('#detailCreateTime').text(response.data.user_create_time);
                    $('#detailUpdateTime').text(response.data.user_update_time);
                    $('#detailUser').modal();
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