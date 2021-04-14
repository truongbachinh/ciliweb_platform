<?php
include "../config_admin.php";
$pPerPage = !empty($_GET['per_page']) ? $_GET['per_page'] : 4;
$currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
$offest = ($currentPage - 1) * $pPerPage;
$countShop = mysqli_query($link, "SELECT * from `shop`");
$result = mysqli_query($link, "SELECT * from `shop`  order by `shop_id` ASC LIMIT " . $pPerPage . " OFFSET " . $offest . "");
$totalShop = $countShop->num_rows;
$totalPage = ceil($totalShop / $pPerPage)
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
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4> Manage Shop </h4>
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
                                include('../pagination/pagination.php');
                                ?>
                                <div class="table-responsive p-t-10">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Id</th>
                                                <th>Shop name</th>
                                                <th>Shop avatar</th>
                                                <th>Shop status</th>
                                                <th>Shop Rank</th>
                                                <th>Create time</th>
                                                <th>Update time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;

                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row["shop_name"]; ?></td>
                                                    <td><?php
                                                        if ($result->num_rows > 0) {
                                                            $imageURL = '../shop/image_shop/' . $row["shop_avatar"];
                                                        ?>
                                                            <img src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                                        <?php
                                                        } else { ?>
                                                            <p>No image(s) found...</p>

                                                        <?php } ?>
                                                    </td>
                                                    <?php
                                                    if (!empty($row['shop_status'] == 1)) {
                                                    ?>

                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-primary">Active</button></td>

                                                    <?php
                                                    } else {  ?>
                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-danger">Block</button></td>
                                                    <?php
                                                    }



                                                    ?>

                                                    <?php
                                                    if (!empty($row['shop_rank'] == 1)) {
                                                    ?>

                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-info">Silver</button></td>

                                                    <?php
                                                    } elseif (!empty($row['shop_rank'] == 2)) {  ?>
                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-warning">Gold</button></td>
                                                    <?php
                                                    } elseif (!empty($row['shop_rank'] == 3)) {  ?>
                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-success">Platinum</button></td>
                                                    <?php
                                                    } elseif (!empty($row['shop_rank'] == 4)) {  ?>
                                                        <td><button style="border-radius: 10px" type="button" class="btn btn-danger">Diamond</button></td>
                                                    <?php
                                                    }



                                                    ?>
                                                    <td><?= date("Y/d/m H:i:s", $row["shop_create_time"]); ?></td>
                                                    <?php
                                                    if (!empty($row['shop_update_time'] == 0)) {

                                                    ?>
                                                        <td style="padding: 2.5%;">Not Update</td>

                                                    <?php
                                                    } else {  ?>
                                                        <td style="padding: 2.5%;"><?= date("Y/d/m H:i:s", $row["shop_update_time"]); ?></td>
                                                    <?php
                                                    }
                                                    ?>

                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" class="btn btn-info  btn-edit-shop" role="button" data-id="<?= $row['shop_id'] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="" class="btn btn-danger btn-delete-shop" role="button" data-id="<?= $row['shop_id'] ?>"><i class="mdi mdi-delete"></i>
                                                            </a>
                                                            <a href="" class="btn btn-primary  btn-detail-shop" role="button" data-id="<?= $row['shop_id'] ?>"><i class="mdi mdi-dots-horizontal"></i> </a>
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
                <!-- Modal Detail -->
                <div class="modal fade" id="detailShop" tabindex="-1" role="dialog" aria-labelledby="detailShop" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailShop">Detail
                                    Information shop
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
                                                <td>Accout create shop</td>
                                                <td id="detailShopAccount"></td>
                                            </tr>
                                            <tr>
                                                <td>Shop name</td>
                                                <td id="detailShopName"></td>
                                            </tr>
                                            <tr>
                                                <td>Shop mail</td>
                                                <td id="detailShopMail"></td>
                                            </tr>
                                            <tr>
                                                <td>Shop address</td>
                                                <td id="detailShopAddress"></td>
                                            </tr>
                                            <tr>
                                                <td>Shop description</td>
                                                <td id="detailShopDescription"></td>
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
                <div class="modal fade" id="editShop" tabindex="-1" role="dialog" aria-labelledby="editShop" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editShop">Edit Shop Information</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="create-account-form">
                                    <div class="form-group">
                                        <label for="editShopName">Shop name</label>
                                        <input type="text" class="form-control" id="editShopName" readonly required>
                                    </div>
                                    <div class="form-group editStatusShop">
                                        <label for="editStatusShop">Shop Status</label>
                                        <select id="editStatusShop" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Blocked</option>
                                        </select>
                                    </div>
                                    <div class="form-group editRankShop">
                                        <label for="editRankShop">Shop rank</label>
                                        <select id="editRankShop" class="form-control">
                                            <option value="1">Silver</option>
                                            <option value="2">Gold</option>
                                            <option value="3">Platinum</option>
                                            <option value="4">Diamond</option>
                                        </select>
                                    </div>
                                    <div class="model-footer">
                                        <button type="button" class="btn btn-warning btn-update-shop">
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
            $(document).on('click', ".btn-delete-shop", function(e) {
                e.preventDefault();
                swal({
                    title: "Please confirm",
                    text: 'Are sure you want to delete this shop?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        Utils.api('delete_shop_info', {
                            id: $(this).data('id'),
                        }).then(response => {
                            swal("Notice", response.msg, "success").then(function(e) {
                                location.reload();
                            });
                        }).catch(err => {})
                    }
                });
            });
            $(document).on('click', '.btn-edit-shop', function(e) {
                e.preventDefault();
                const shopId = parseInt($(this).data("id"));
                activeId = shopId;
                console.log(shopId);
                Utils.api("get_shop_info", {
                    id: shopId
                }).then(shop => {
                    $("input#editShopName").val(shop.data.shop_name)
                    $("#editStatusShop").val(shop.data.shop_status)
                    $("#editRankShop").val(shop.data.shop_rank)
                    $('#editShop').modal();
                }).catch(err => {

                });
            });
            $(document).on('click', '.btn-update-shop', function(e) {
                Utils.api("update_shop_info", {
                    id: activeId,
                    editStatusShop: $("#editStatusShop").val(),
                    editRankShop: $("#editRankShop").val(),
                }).then(response => {
                    $("#editUser").modal("hide");
                    swal("Notice", "Record is updated successfully!", "success").then(function(e) {
                        location.replace("./manage_shop.php");
                    });
                }).catch(err => {

                })
            });
            $(document).on('click', '.btn-detail-shop', function(e) {
                e.preventDefault();
                const shopId = parseInt($(this).data("id"));
                console.log(shopId)
                Utils.api('get_shop_info_detail', {
                    id: shopId
                }).then(response => {
                    $('#detailShopAccount').text(response.data.username);
                    $('#detailShopName').text(response.data.shop_name);
                    $('#detailShopMail').text(response.data.email);
                    $('#detailShopAddress').text(response.data.shop_address);
                    $('#detailShopDescription').text(response.data.shop_description);
                    // var createDate = date("Y-m-d H:i:s", response.data.shop_create_time);
                    // $('#detailShopCreateTime').text(createDate);
                    // $('#detailShopUpdateTime').text(date("Y-m-d H:i:s", response.data.shop_update_time));
                    $('#detailShop').modal();
                }).catch(err => {

                })
            });
        })
    </script>
</body>

</html>