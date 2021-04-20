<?php
include "../config_shop.php";
$idCtg = $_GET["idctg"];
$shopId = $_GET["idsh"];
if (!isset($_SESSION['current_user'])) {
    header("location: ../account/login.php");
}
// $pPerPage = !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
// $currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
// $offest = ($currentPage - 1) * $pPerPage;
// $countProduct = mysqli_query($link, "SELECT * from `products` where `p_category_id`= '$idCtg' AND `p_shop_id` = '$shopId'");
// $totalProduct = $countProduct->num_rows;
// $totalPage = ceil($totalProduct / $pPerPage);

// $resultProduct = $link->query("SELECT products.*, categories.*,shop.* from products INNER JOIN categories ON products.p_category_id = categories.ctg_id INNER JOIN shop ON products.p_shop_id = shop.shop_id where categories.ctg_id = '$idCtg' AND shop.shop_id = '$shopId'  order by `p_id` ASC LIMIT " . $pPerPage . " OFFSET " . $offest . "");

$result = $link->query("SELECT categories.* from categories  where ctg_id = $idCtg");
$resultCategories = mysqli_fetch_assoc($result);
$resultProduct = $link->query("SELECT products.*, categories.*,shop.* from products INNER JOIN categories ON products.p_category_id = categories.ctg_id INNER JOIN shop ON products.p_shop_id = shop.shop_id where categories.ctg_id = '$idCtg' AND shop.shop_id = '$shopId'  order by `p_id` ASC");
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
                                    <h4>List product of <?= $resultCategories['ctg_name'] ?> </h4>
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
                                        <a href="" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#addRole"><i class="mdi mdi-clipboard-plus"></i> Add new product
                                        </a>
                                    </div>
                                </div>

                                <div class="table-responsive p-t-10">
                                    <table id="table_id" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Id</th>
                                                <th>Product name</th>
                                                <th>Product fresh</th>
                                                <th>Product quantity</th>
                                                <th>Product price</th>
                                                <th>Product image</th>
                                                <th>Create time</th>
                                                <!-- <th>Update time</th> -->
                                                <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            if (!empty($resultProduct)) {
                                                while ($row = mysqli_fetch_array($resultProduct)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $row["p_name"]; ?></td>
                                                        <td><?= $row["p_fresh"]; ?>/10</td>
                                                        <td><?= $row["p_quantity"]; ?></td>
                                                        <td><?php echo  number_format($row["p_price"], 0, ",", "."), ' VNĐ'; ?></td>
                                                        <td><?php
                                                            if ($result->num_rows > 0) {
                                                                $imageURL = '../shop/image_products/' . $row["p_image"];
                                                            ?>
                                                                <img src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                                            <?php
                                                            } else { ?>
                                                                <p>No image(s) found...</p>
                                                            <?php } ?>
                                                        </td>

                                                        <td><?= date("Y/d/m H:i:s", $row["p_date_create"]); ?></td>
                                                        <!-- <?php
                                                                if (!empty($row['p_date_update'] == 0)) {

                                                                ?>
                                                            <td style="padding: 2.5%;">Not Update</td>

                                                        <?php
                                                                } else {  ?>
                                                            <td style="padding: 2.5%;"><?= date("Y/d/m H:i:s", $row["p_date_update"]); ?></td>
                                                        <?php
                                                                }
                                                        ?> -->

                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="" class="btn btn-info  btn-edit-product" role="button" data-id="<?= $row['p_id'] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                                <a href="" class="btn btn-danger btn-delete-product" role="button" data-id="<?= $row['p_id'] ?>"><i class="mdi mdi-delete"></i>
                                                                </a>
                                                                <a href="" class="btn btn-primary  btn-detail-product" role="button" data-id="<?= $row['p_id'] ?>"><i class="mdi mdi-dots-horizontal"></i> </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
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
                                <h5 class="modal-title" id="addRole">Add new product</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" name="manageProduct" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label">Product Name :</label>
                                        <input type="text" class="form-control" id="inputNameProduct" name="nameProduct" placeholder="Enter name of product" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Product Description :</label>
                                        <input type="text" class="form-control" id="descriptionProduct" name="descriptionProduct" placeholder="Enter name of topic" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Product Fresh :</label>
                                        <input type="number" class="form-control" id="freshProduct" name="freshProduct" placeholder="Enter fresh " required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Product Quantity :</label>
                                        <input type="number" class="form-control" id="quantityProduct" name="quantityProduct" placeholder="Enter quantity" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Product price :</label>
                                        <input type="number" class="form-control" id="priceProduct" name="priceProduct" placeholder="Enter price" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Product Image :</label>
                                        <input type="file" class="form-control" id="imageProduct" name="imageProduct" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Product Image Library :</label>
                                        <input type="file" class="form-control" id="imageProduct" name="imageProductLibrary[]" multiple required>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-md float-right" name="addProduct" value="Create product">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Detail -->
                <div class="modal fade" id="detailProduct" tabindex="-1" role="dialog" aria-labelledby="detailProduct" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailProduct">Detail
                                    Information product
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
                                                <td>Product category</td>
                                                <td id="detailProductCategory"></td>
                                            </tr>
                                            <tr>
                                                <td>Product Name</td>
                                                <td id="detailProductName"></td>
                                            </tr>
                                            <tr>
                                                <td>Product description</td>

                                                <td id="detailProductDescription"></td>
                                            </tr>
                                            <tr>
                                                <td>Product image library</td>
                                                <td>
                                                    <img src="" id="detailImage" width="65" height="65">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Product update time</td>
                                                <td id="detailUpdateTime"></td>
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
            $('#table_id').DataTable();
        });
        document.addEventListener("DOMContentLoaded", function(e) {
            let activeId = null;
            $(document).on('click', ".btn-delete-product", function(e) {
                e.preventDefault();
                swal({
                    title: "Please confirm",
                    text: 'Are sure you want to delete this user?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        Utils.api('delete_product_info', {
                            id: $(this).data('id'),
                        }).then(response => {
                            swal("Notice", response.msg, "success").then(function(e) {
                                location.replace("./view_product_in_categories.php?idsh=<?= $shopId ?>&idctg=<?= $idCtg ?>");
                            });
                        }).catch(err => {})
                    }
                });
            });
            $(document).on('click', '.btn-detail-product', function(e) {
                e.preventDefault();
                var pathFile = "../shop/image_products/";
                const productId = parseInt($(this).data("id"));
                console.log(productId)
                Utils.api('get_product_info_detail', {
                    id: productId
                }).then(response => {
                    $('#detailProductCategory').text(response.data.ctg_name);
                    $('#detailProductName').text(response.data.p_name);
                    $('#detailProductDescription').text(response.data.p_description);
                    $("#detailImage").attr("src", pathFile.concat(response.data.img_name));
                    $('#detailUpdateTime').text(response.data.p_date_update);
                    $('#detailProduct').modal();
                }).catch(err => {

                })
            });
        })
    </script>
</body>

</html>

<?php

if (isset($_POST["addProduct"])) {

    $count = 0;
    $resultP = $link->query("SELECT * from products where p_name ='$_POST[nameProduct]'");
    $count = mysqli_num_rows($resultP);

    if ($count > 0) {
?>
        <script type="text/javascript">
            alert("Product exits !");
            window.location.replace("./view_product_in_categories.php?idsh=<?= $shopId ?>&idctg=<?= $idCtg ?>");
        </script>
    <?php
    } else {

        // File upload configuration 
        $tm = md5(time());
        $statusMsg = '';
        $uploadPath = "./image_products/";
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fileName =  $tm . basename($_FILES['imageProduct']['name']);
        $targetFilePath = $uploadPath . $fileName;
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        // Check whether file type is valid 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (!empty($fileName)) {

            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["imageProduct"]["tmp_name"], $targetFilePath)) {
                    $addProduct = $link->query("INSERT INTO `products` (`p_id`, `p_category_id`, `p_shop_id`, `p_name`, `p_description`, `p_fresh`, `p_quantity`, `p_price`, `p_image`,  `p_date_create`) VALUES (NULL,'$idCtg','$shopId','$_POST[nameProduct]','$_POST[descriptionProduct]','$_POST[freshProduct]','$_POST[quantityProduct]','$_POST[priceProduct]','$fileName','" . time() . "')");
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }



        // File upload configuration 
        $tm = md5(time());
        $uploadPathImgLib = "./image_library/";

        if (!is_dir($uploadPathImgLib)) {
            mkdir($uploadPathImgLib, 0777, true);
        }

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';

        $fileNames = array_filter($_FILES['imageProductLibrary']['name']);
        if (!empty($fileNames)) {
            foreach ($_FILES['imageProductLibrary']['name'] as $key => $val) {
                // File upload path 
                $fileName =  $tm . basename($_FILES['imageProductLibrary']['name'][$key]);
                $targetFilePath = $uploadPathImgLib . $fileName;

                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    // Upload file to server 
                    if (move_uploaded_file($_FILES["imageProductLibrary"]["tmp_name"][$key], $targetFilePath)) {
                        // Image db insert sql 

                        $insertId = $link->insert_id;
                        $insertValuesSQL .= "( ' $insertId', '" . $fileName . "', '" . time() . "')";
                        // $insertValuesSQL .= "('" . $fileName . "', NOW()),";
                        // var_dump($insertValuesSQL);

                        if ($key != count($_FILES["imageProductLibrary"]["tmp_name"]) - 1) {
                            $insertValuesSQL .=  ",";
                        }
                        // var_dump(count($_FILES) - 1);
                        // var_dump($key);
                    } else {
                        $errorUpload .= $_FILES['imageProductLibrary']['name'][$key] . ' | ';
                    }
                } else {
                    $errorUploadType .= $_FILES['imageProductLibrary']['name'][$key] . ' | ';
                }
            }

            if (!empty($insertValuesSQL)) {
                // $insertValuesSQL = trim($insertValuesSQL, ',');
                // Insert image file name into database 


                $insertImg = $link->query("INSERT INTO `image_library` (`img_p_id`,`img_name`, `img_create_time`)  VALUES $insertValuesSQL");
                // var_dump($insertImg);
                // exit;




                if ($insertImg) {
                    $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                    $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                    $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                    $statusMsg = "Files are uploaded successfully." . $errorMsg;
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }
    }
    if ($addProduct == true && $insertImg  == true) {
    ?>
        <script type="text/javascript">
            alert("add product success !");
            window.location.replace("./view_product_in_categories.php?idsh=<?= $shopId ?>&idctg=<?= $idCtg ?>");
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("error !");
            window.location.replace("./view_product_in_categories.php?idsh=<?= $shopId ?>&idctg=<?= $idCtg ?>.php");
        </script>
<?php
    }
}

?>