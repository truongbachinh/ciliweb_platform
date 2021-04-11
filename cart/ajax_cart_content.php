<div class="container-fluid">
    <?php
    if (!isset($_SESSION)) {
        include "../config_user.php";
    }
    if (!empty($_SESSION["current_user"]['username'])) {

        $cartUserId = $_SESSION["current_user"]['user_id'];
    }
    if (!empty($_SESSION["current_user_social"]['fullname'])) {

        $cartUserId = $_SESSION["current_user_social"]['user_id'];
    }
    if (!empty($cartUserId)) {

        $result = $link->query("SELECT cart.*, products.*, shop.* from cart INNER JOIN products on cart.cart_product_id = products.p_id INNER JOIN shop ON shop.shop_id = products.p_shop_id where cart_user_id ='$cartUserId' GROUP BY shop.shop_id");
        $cartShopInfor = array();
        while ($rowShop = mysqli_fetch_array($result)) {
            $cartShopInfor[] =  $rowShop;
        }
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <div class="table-responsive p-t-10">
        <form action="../payment/checkout.php" method="post" id="updateCartProduct" enctype="multipart/form-data">
            <div class="table-responsive p-t-10">
                <?php
                if (!empty($result)) {
                    $totalCostAmoutShop = 0;
                    foreach ($cartShopInfor as $rowShop) {
                        $rowShopId = $rowShop['shop_id'];
                        $cartProduct = $link->query("SELECT cart.*, products.*, shop.* from cart INNER JOIN products on cart.cart_product_id = products.p_id INNER JOIN shop ON shop.shop_id = products.p_shop_id where cart_user_id ='$cartUserId' and shop_id = '$rowShopId'");
                        $myCartProduct = array();
                        while ($rowCartProduct = mysqli_fetch_array($cartProduct)) {
                            $myCartProduct[] =  $rowCartProduct;
                        }  ?>
                        <table class="table table-hover table-bordered table-striped" style="text-align: center; background-color:blanchedalmond !important">
                            <div id="cart-shop">
                                <div><img src="../shop/image_shop/<?= $rowShop['shop_avatar'] ?>" width="60" height="70"></div>
                                <div id="breadcrumb"><i class="fa fas-home" style="margin-left: 9px;"> Order of shop <i class="mdi mdi-arrow-right mdi-14px "></i><?php echo "<font>" . $rowShop['shop_name'] . "</font>" ?></a></i></div>
                            </div>
                            <thead>
                                <tr>
                                    <!-- <th>Select</th> -->
                                    <th>NO.</th>
                                    <th>Product name</th>
                                    <th>Image</th>
                                    <th>Amount</th>
                                    <th>Price (VND)</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $total = 0;
                                $totalCost = 0;
                                $count = 0;
                                $i = 1;
                                foreach ($myCartProduct  as $rowMyCartProduct) {
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $rowMyCartProduct['p_name'] ?></td>
                                        <td><img src="../shop/image_products/<?= $rowMyCartProduct['p_image'] ?>" width="60" height="70"></td>
                                        <td>
                                            <!-- <div class="input-group" id="quantity-product">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quantity[<?= $rowMyCartProduct['cart_id'] ?>]">
                                                        <span><i class="fas fa-minus"></i></span>
                                                    </button>
                                                </span>
                                                <input type="text" oninput="javascript:updateQuantity(this.value)" name="quantity[<?= $rowMyCartProduct['cart_id'] ?>]" class="form-control input-number" value="<?= $rowMyCartProduct["cart_quantity"] ?>" min="1" max="<?= $rowMyCartProduct['p_quantity'] ?>">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quantity[<?= $rowMyCartProduct['cart_id'] ?>]">
                                                        <span><i class="fas fa-plus"></i></span>
                                                    </button>
                                                </span>
                                            </div> -->


                                            <input type="number" oninput="javascript:updateQuantity(this.value)" value="<?= $rowMyCartProduct["cart_quantity"] ?>" name="quantity[<?= $rowMyCartProduct['cart_id'] ?>]" min="1" max="<?= $rowMyCartProduct['p_quantity'] ?>">
                                        </td>
                                        <td><?= number_format($cost = $rowMyCartProduct["cart_quantity"] *  $rowMyCartProduct["p_price"], 0, ",", ".")   ?>VNĐ</td>
                                        <td><a href="javascript:deleteCartItem(<?= $rowMyCartProduct['cart_id'] ?>)"><i class="mdi mdi-delete-empty mdi:20px"></i></a></td>
                                    </tr>


                                <?php
                                    // var_dump($cost);
                                    $total += $cost;
                                }
                                ?>
                                <tr>
                                    <td>Total Cost</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td> &nbsp;</td>
                                    <td><?= number_format($total, 0, ",", ".") ?></td>
                                    <td>Delete</td>
                                </tr>

                            <?php
                            $totalCost += $total;
                            $totalCostAmoutShop += $totalCost;
                        }

                            ?>

                        <?php



                    }




                        ?>
                            </tbody>
                        </table>

                        <div class="total-cost-all" style="float:right">
                            <?php
                            if (!empty($totalCostAmoutShop)) {
                            ?>
                                <span><b>Total cost</b></span>&emsp;&emsp;<span><?= number_format($totalCostAmoutShop, 0, ",", ".") ?>VNĐ</span>

                            <?php
                            }
                            ?>

                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                            <input type="submit" class="btn btn-success" name="checkoutCart" value="Checkout"></input>
                        </div>

            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        var $item = $('div#view-list-libImg'), //Cache your DOM selector
            visible = 3, //Set the number of items that will be visible
            index = 0, //Starting index
            endIndex = ($item.length / visible) - 1; //End index

        $('div#arrowR').click(function() {
            debugger;

            if (index < endIndex) {
                index++;
                $item.animate({
                    'left': '-=300px'
                });
            }
        });

        $('div#arrowL').click(function() {
            if (index > 0) {
                index--;
                $item.animate({
                    'left': '+=300px'
                });
            }
        });

    });

    $('.btn-number').click(function(e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function() {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>