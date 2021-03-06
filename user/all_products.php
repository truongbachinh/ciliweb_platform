<?php
// $pPerPage = 20;
$pPerPage = !empty($_GET['per_page']) ? $_GET['per_page'] : 5;
$currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
$offest = ($currentPage - 1) * $pPerPage;
$totalProduct = mysqli_query($link, "select * from products");
$totalProduct = $totalProduct->num_rows;
$totalPage = ceil($totalProduct / $pPerPage);

$query_search = $link->query("SELECT categories.*, shop.*, products.* from products INNER JOIN shop ON shop.shop_id = products.p_shop_id INNER JOIN categories ON products.p_category_id = categories.ctg_id order by `p_id` ASC LIMIT " . $pPerPage . " OFFSET " . $offest . "");

// $query_search = $link->query("SELECT categories.*, shop.*, products.* from products INNER JOIN shop ON shop.shop_id = products.p_shop_id INNER JOIN categories ON products.p_category_id = categories.ctg_id order by `p_id` ASC LIMIT " . $pPerPage . " OFFSET " . $offest . "");



// var_dump($totalProduct);
// exit;
?>
<link rel="stylesheet" href="./css/all_products.css">
</link>



<div class="container-fluid result-search">
    <div id="title-categories">
        <p style="background: #7abaa1;
    padding: 10px;
    border-left: 5px solid #ff284b;
    font-weight: bold;
    font-size: 18px;
    border-radius:12px;
    color:white">
            All Of Product
        </p>
    </div>
    <?php
    include('./pagination/pagination.php');
    ?>
    <div class="list-all-product flex-container">
        <?php
        while ($productInfor = mysqli_fetch_array($query_search, MYSQLI_ASSOC)) {
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
            <div class="card align-items-center" id="card-product">
                <a href="index.php?view=foodInfo&idl=<?= $productInfor['p_category_id'] ?>&id=<?= $productInfor['p_id'] ?>&idsh=<?= $productInfor['shop_id'] ?>" style="text-decoration:none">
                    <div class="card-header-product">
                        <img src="../shop/image_products/<?= $productInfor['p_image'] ?>" class="rounded card-img-top " height="175" width="175" alt="product...">
                    </div>
                    <div class="card-body">
                        <p><?= $productInfor['p_name'] ?></p>
                        <p style="color: red; font-size: 14px;">
                            <?= number_format($productInfor['p_price'], 0, ",", ".")  ?> VN??
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
        <?php }
        ?>
    </div>
</div>


<?php
include('./pagination/pagination.php');

?>