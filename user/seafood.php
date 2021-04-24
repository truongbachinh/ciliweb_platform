<div class="post-wrapper">
    <!-- Loading overlay -->
    <div class="loading-overlay">
        <div class="overlay-content">Loading...</div>
    </div>

    <!-- Post list container -->
    <div id="postContent">
        <?php
        // Include pagination library file 
        include_once 'Pagination.class.php';

        // Include database configuration file 
        require_once '../connect_db.php';

        // Set some useful configuration 
        $baseURL = 'getData.php';
        $limit = 10;

        // Count of all records 
        $query   = $link->query("SELECT COUNT(*) as rowNum FROM products");
        $result  = $query->fetch_assoc();
        $rowCount = $result['rowNum'];

        // Initialize pagination class 
        $pagConfig = array(
            'baseURL' => $baseURL,
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'contentDiv' => 'postContent',
            'link_func' => 'searchFilter'
        );
        $pagination =  new Pagination($pagConfig);

        // Fetch records based on the limit 
        $query = $link->query("SELECT categories.*, shop.*, products.* from products INNER JOIN shop ON shop.shop_id = products.p_shop_id INNER JOIN categories ON products.p_category_id = categories.ctg_id ORDER BY p_id DESC LIMIT $limit");

        if ($query->num_rows > 0) {
        ?>
            <!-- Display posts list -->
            <!-- <div class="post-list"> -->

            <div class="list-all-product flex-container">
                <?php while ($productInfor = $query->fetch_assoc()) {

                    $idProductSold  = $productInfor['p_id'];
                    $queryTotalSold = $link->query("SELECT SUM(order_items.quantity) as total_sold FROM order_items INNER JOIN orders ON orders.id = order_items.order_id WHERE order_items.order_product_id = ' $idProductSold ' and orders.shipping_order_status = '3'");
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
                        <a href="index.php?view=foodInfo&idl=<?php echo $productInfor['p_category_id'] ?>&id=<?php echo $productInfor['p_id'] ?>&idsh=<?php echo $productInfor['shop_id'] ?>" style="text-decoration:none">
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
                                <form action="../cart/cart.php?view=add_to_cart" class="buy-now-form" method="post" enctype="multipart/form-data">
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
        ?>
    </div>
</div>