<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];




$pPerPage = !empty($_GET['per_page']) ? $_GET['per_page'] : 2;
$currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
$offest = ($currentPage - 1) * $pPerPage;
$countOrder = $link->query("SELECT * from orders where order_shop_id = $shopId");
$res = $link->query("SELECT orders.*,user.*,order_address.* from orders INNER JOIN order_address ON orders.id = order_address.oda_order_id INNER JOIN user ON user.user_id = orders.order_user_id where order_shop_id  = $shopId order by `id` ASC LIMIT " . $pPerPage . " OFFSET " . $offest . " ");
$totalOrder = $countOrder->num_rows;
$totalPage = ceil($totalOrder / $pPerPage);

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
                                </div>
                                <?php
                                include("../pagination/pagination.php");
                                ?>
                                <div class="table-responsive p-t-10">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Order Id</th>
                                                <th>User name</th>
                                                <th>Fullname</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Total</th>
                                                <th>Quantity</th>
                                                <th>Payment status</th>

                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($res)) {

                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $row['username'] ?></td>
                                                    <td><?= $row['oda_firstname'], " ", $row['oda_lastname'] ?></td>
                                                    <td><?= $row['oda_phone'] ?></td>
                                                    <td><?= $row['oda_address'] ?></td>
                                                    <td><?= $row['order_total_cost'] ?></td>
                                                    <td><?= $row['order_total_amount'] ?></td>
                                                    <td>NOT YET</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" class="btn btn-info  btn-edit-order" role="button" data-id="<?= $row["id"] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="" class="btn btn-danger btn-delete-order" role="button" data-id="<?= $row["id"] ?>"><i class="mdi mdi-delete"></i>
                                                            </a>
                                                            <a href="" class="btn btn-primary  btn-detail-order" role="button" data-id="<?= $row["id"] ?>"><i class="mdi mdi-dots-horizontal"></i> </a>
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
                                include("../pagination/pagination.php");
                                ?>
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

                <div class="modal fade" id="editOrder" tabindex="-1" role="dialog" aria-labelledby="editOrder" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editOrder">Update Oder Information</h5>
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
            $(document).on('click', '.btn-edit-order', function(e) {
                e.preventDefault();

                const orderId = parseInt($(this).data("id"));
                activeId = orderId;
                console.log(orderId);
                Utils.api("get_order_info", {
                    id: orderId
                }).then(response => {

                    $('#editOrder').modal();
                }).catch(err => {

                });
            });

        })
    </script>
</body>

</html>