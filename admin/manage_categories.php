<?php

include "../config_admin.php";
if (!isset($_SESSION['current_user'])) {
    header("location: ./account/login.php");
}


$result = mysqli_query($link, "SELECT * from `categories`  order by `ctg_id` ");

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

        <section class="manage-page">
            <div class="container m-t-30">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4> Manage Categories </h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#addCategories"><i class="mdi mdi-clipboard-plus"></i> Add neu categories
                                        </a>
                                    </div>
                                </div>

                                <div class="table-responsive p-t-10">
                                    <table id="table_manage_categories" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Id</th>
                                                <th>Categories name</th>
                                                <th>Categories image</th>
                                                <th>Categories status</th>
                                                <th>Create time</th>
                                                <th>Update time</th>
                                                <th>View Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row["ctg_name"]; ?></td>
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
                                                    <td><?=
                                                        date('d-M-Y  H:i:s', strtotime($row["ctg_create_time"]))
                                                        ?></td>
                                                    <?php
                                                    if (!empty($row['ctg_update_time'] == 0)) {

                                                    ?>
                                                        <td style="padding: 2.5%;">Not Update</td>

                                                    <?php
                                                    } else {  ?>
                                                        <td style="padding: 2.5%;"><?=
                                                                                    date('d-M-Y  H:i:s', strtotime($row["ctg_update_time"])) ?></td>
                                                    <?php
                                                    }
                                                    ?>

                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" class="btn btn-info  btn-edit-categories" role="button" data-id="<?= $row['ctg_id'] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="" class="btn btn-danger btn-delete-categories" role="button" data-id="<?= $row['ctg_id'] ?>"><i class="mdi mdi-delete"></i>
                                                            </a>
                                                            <a href="" class="btn btn-primary  btn-detail-categories" role="button" data-id="<?= $row['ctg_id'] ?>"><i class="mdi mdi-dots-horizontal"></i> </a>
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
                <!-- Modal add  -->
                <div class="modal fade" id="addCategories" tabindex="-1" role="dialog" aria-labelledby="addCategories" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCategories">Add categories</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" name="manageCategories" id="addCategoriesForm" method="POST" enctype="multipart/form-data">
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
                <div class="modal fade" id="detailCategory" tabindex="-1" role="dialog" aria-labelledby="detailCategory" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailCategory">Detail
                                    Information category
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
                                                <td>Image</td>
                                                <td>
                                                    <img src="" height="150" width="150" id="displayImageDetail" style="margin-left: 10px; margin-bottom: 20px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Category</td>
                                                <td id="detailCategoryName"></td>
                                            </tr>
                                            <tr>
                                                <td>Category description</td>
                                                <td id="detailCtgDescription"></td>
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

                <div class="modal fade" id="editCategories" tabindex="-1" role="dialog" aria-labelledby="editCategories" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCategories">Edit Categories Information</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="create-account-form">
                                    <div class="form-group">
                                        <label for="editCategory">Category</label>
                                        <input type="text" class="form-control" id="editCategory" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editCtgDescription">Description</label>
                                        <input type="text" class="form-control" id="editCtgDescription" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="editCtgImage">Image</label>
                                        <input type="file" class="form-control" id="editCtgImage" required>
                                        <img src="" height="50" width="50" id="displayImageEdit" style="margin-left: 10px;">
                                    </div> -->
                                    <div class="form-group">
                                        <div>
                                            <p class=" font-secondary">Product Image</p>
                                            <div class="input-group mb-3">
                                                <div onload="GetFileInfo ()">
                                                    <input type="file" class="custom-file-input" id="inputFile" name="editCtgImage" onchange="GetFileInfo ()">
                                                    <label class="custom-file-label" for="inputFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div id="info" style="margin-top:10px"></div>
                                        </div>
                                        <img src="" height="50" width="50" id="displayImageEdit" style="margin-left: 10px;">
                                        <input type="hidden" id="editCtgImageVal" name="editCtgImageVal">

                                    </div>


                                    <div class=" form-group">
                                        <label for="editCtgStatus">Status</label>
                                        <select id="editCtgStatus" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Blocked</option>
                                        </select>
                                    </div>


                                    <div class="model-footer">
                                        <button type="button" class="btn btn-warning btn-update-categories">
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

            $('#addCategoriesForm').validate({
                rules: {
                    nameCategories: {
                        required: true,
                        lettersOnly: true
                    },
                    descriptionCategories: {
                        required: true,

                    },
                    imageCategories: {
                        required: true,

                    },



                },
                messages: {

                    nameCategories: {
                        required: "Please provide product name!",
                        lettersOnly: " Please enter letter only!"
                    },
                    descriptionCategories: {
                        required: "Please provide information!",
                    },
                    imageCategories: {
                        required: "Please provide imamge!",
                    },
                },
            })
            $('#table_manage_categories').DataTable();
        });
        document.addEventListener("DOMContentLoaded", function(e) {
            let activeId = null;
            $(document).on('click', ".btn-delete-categories", function(e) {
                e.preventDefault();
                swal({
                    title: "Please confirm",
                    text: 'Are sure you want to delete this categories?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        Utils.api('delete_categories_info', {
                            id: $(this).data('id'),
                        }).then(response => {
                            swal("Notice", response.msg, "success").then(function(e) {
                                location.reload();
                            });
                        }).catch(err => {})
                    }
                });
            });

            $(document).on('click', '.btn-edit-categories', function(e) {
                e.preventDefault();
                var pathFile = "../admin/image_categories/";
                const ctgId = parseInt($(this).data("id"));
                activeId = ctgId;
                console.log(ctgId);
                Utils.api("get_categories_info", {
                    id: ctgId
                }).then(ctg => {
                    $("input#editCategory").val(ctg.data.ctg_name)
                    $("#editCtgDescription").val(ctg.data.ctg_description)
                    $('#displayImageEdit').attr('src', pathFile.concat(ctg.data.ctg_image));
                    // $("img#displayImageEdit").attr('src', $("img#displayImageEdit").attr('src') + './image_categories/' + val(ctg.data.ctg_image));
                    $("#editCtgStatus").val(ctg.data.ctg_status)
                    $("#editCtgImageVal").val(ctg.data.ctg_image)
                    $('#editCategories').modal();
                }).catch(err => {

                });
            });
            $(document).on('click', '.btn-update-categories', function(e) {
                Utils.api("update_categories_info", {
                    id: activeId,
                    editCategory: $("#editCategory").val(),
                    editCtgDescription: $("#editCtgDescription").val(),
                    editCtgStatus: $("#editCtgStatus").val(),
                    editCtgImage: $(".editCtgImage").val(),
                    editCtgImageNotchange: $("#editCtgImageVal").val(),
                }).then(response => {
                    $("#editCategories").modal("hide");
                    swal("Notice", "Record is updated successfully!", "success").then(function(e) {
                        location.replace("./manage_categories.php");
                    });
                }).catch(err => {

                })
            });

            $(document).on('click', '.btn-detail-categories', function(e) {
                e.preventDefault();
                var pathFile = "../admin/image_categories/";
                const ctgId = parseInt($(this).data("id"));
                activeId = ctgId;
                console.log(ctgId);
                Utils.api("get_categories_info", {
                    id: ctgId
                }).then(ctg => {
                    $('#displayImageDetail').attr('src', pathFile.concat(ctg.data.ctg_image));
                    $("#detailCategoryName").text(ctg.data.ctg_name)
                    $("#detailCtgDescription ").text(ctg.data.ctg_description)
                    $('#detailCategory').modal();
                }).catch(err => {

                });
            });
        })
    </script>
</body>

</html>
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
                    $addCategories = $link->query("INSERT INTO `categories` (`ctg_id`,`ctg_name`,`ctg_description`, `ctg_image`,  `ctg_status`,  `ctg_create_time`) VALUES(NULL,'$_POST[nameCategories]','$_POST[descriptionCategories]','$fileName','1','" . $timeInVietNam  . "')");
                }
                if ($addCategories) {
        ?>
                    <script type="text/javascript">
                        swal("Notice", "Add successfully!", "success").then(function(e) {
                            location.replace("./manage_categories.php");
                        });
                    </script>
                <?php
                } else {
                ?>
                    <script type="text/javascript">
                        swal("Notice", $statusMsg, "success").then(function(e) {
                            location.replace("./manage_categories.php");
                        });
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