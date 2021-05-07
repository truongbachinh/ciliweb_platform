<?php

if (isset($_POST['page'])) {
    session_start();
    // Include pagination library file 
    include_once 'Pagination.class.php';

    // Include database configuration file 
    require_once '../connect_db.php';

    // Set some useful configuration 
    $baseURL = 'getData.php';
    $offset = !empty($_POST['page']) ? $_POST['page'] : 0;
    $limit = 15;

    // Set conditions for search 
    $whereSQL = $orderSQL = $trimShop = $trimCtg = $and  =  '';

    if (!empty($_POST['shop'])) {
        $varShop = $_SESSION['shop'] = $_POST['shop'];
        $and  .=  " AND p_shop_id = " . $varShop . "";
    }

    if (!empty($_POST['category'])) {
        $varCtg = $_SESSION['ctg'] = $_POST['category'];
        $and .= " AND p_category_id = " . $varCtg . "";
    }

    $whereSQL = "WHERE p_name LIKE '%" . $_POST['keywords'] . "%'" . $and;

    if (!empty($_POST['sortBy'])) {
        $orderSQL = " ORDER BY p_price " . $_POST['sortBy'];
    } else {
        $orderSQL = " ORDER BY p_price DESC ";
    }

    var_dump($whereSQL);
    // exit;
    // Count of all records 
    $query   = $link->query("SELECT COUNT(*) as rowNum FROM products " . $whereSQL . $orderSQL);

    $result  = $query->fetch_assoc();

    $rowCount = $result['rowNum'];

    // Initialize pagination class 
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'currentPage' => $offset,
        'contentDiv' => 'postContent',
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit 
    $query = $link->query("SELECT  products.* from products  $whereSQL $orderSQL LIMIT $offset,$limit");

    if ($query->num_rows > 0) {
?>

        <!-- Display posts list -->
        <!-- <div class="post-list"> -->
        <div class="list-all-product flex-container">

            <?php while ($productInfor = $query->fetch_assoc()) {

                $idProductSold  = $productInfor['p_id'];
                $queryTotalSold = $link->query("SELECT SUM(order_items.quantity) as total_sold FROM order_items WHERE order_items.order_product_id = ' $idProductSold ' ");
                $totalSold = $queryTotalSold->fetch_assoc();
                $totalSoldOfShop = $totalSold['total_sold'];
                $totalProduct = $productInfor['p_quantity'];
                if ($totalProduct != 0) {
                    $with = $totalSoldOfShop / $totalProduct * 100;
                    $widthBar = $with . '%';
                } else {
                    $widthBar = '100%';
                }
            ?>

                <!-- <div class="list-item"><a href="#"><?php echo $row["p_name"]; ?></a></div> -->

                <div class="card align-items-center" id="card-product">
                    <a href="index.php?view=foodInfo&idl=<?= $productInfor['p_category_id'] ?>&id=<?= $productInfor['p_id'] ?>&idsh=<?= $productInfor['shop_id'] ?>" style="text-decoration:none">
                        <div class="card-header-product">
                            <img src="../shop/image_products/<?= $productInfor['p_image'] ?>" class="rounded card-img-top " height="175" width="175" alt="product...">
                        </div>
                        <div class="card-body">
                            <p><?= $productInfor['p_name'] ?></p>
                            <p style="color: red; font-size: 14px;">
                                <?= number_format($productInfor['p_price'], 0, ",", ".")  ?> VNĐ
                            </p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow=" <?= $totalSoldOfShop ?>" aria-valuemin="0" aria-valuemax="<?= $totalProduct ?>" style='width:<?= $widthBar ?>'>
                                    Sold <?= $totalSoldOfShop  ?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="card-footer-product">
                        <?php
                        if ($productInfor["p_quantity"] > "0") {
                        ?>
                            <form action="" class="buy-now-form" method="post" enctype="multipart/form-data">
                                <input type="text" value="1" name="quantity[<?= $productInfor['p_id'] ?>]" hidden="true">
                                <input type="submit" class="btn" id="btn-buy" value="Buy Now">
                            </form>
                        <?php
                        } else {
                        ?>
                            <input type="submit" class="btn btn-danger" value="Sold out">
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Display pagination links -->
        <?php echo $pagination->createLinks(); ?>
<?php
    } else {
        echo '<p>Post(s) not found...</p>';
    }
}
?>

<?php include "../partials/footer_user.php"; ?>
<?php
?>