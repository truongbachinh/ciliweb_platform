<?php
session_start();
include "../connect_db.php";
include "../header.php";


if (!empty($_SESSION["current_user"]['username'])) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = $_SESSION["current_user"]['user_id']  = array();
    }
}
if (!empty($_SESSION["current_user_social"]['username'])) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = $_SESSION["current_user_social"]['user_id'] = array();
    }
}

if (isset($_SESSION["current_user"]['username']) || isset($_SESSION["current_user_social"]['fullname'])) {
    $error = false;
    $success = false;
    if (isset($_GET["view"])) {
        function update_cart($add = false)
        {
            foreach ($_POST['quantity'] as $id => $quantity) {

                if ($quantity == 0) {
                    unset($_SESSION["cart"][$id]);
                } else {
                    if (!isset($add)) {
                        $_SESSION["cart"][$id] += $quantity;
                    } else {
                        $_SESSION["cart"][$id] = $quantity;
                    }
                }
            }
        }
        switch ($_GET['view']) {
            case "add_to_cart";

                update_cart($add = true);
                // header('location: ./cart.php');
                break;
            case "delete";
                // var_dump($_SESSION["cart"]);
                // exit;
                // echo "delete";
                if (isset($_GET['id'])) {
                    unset($_SESSION["cart"][$_GET['id']]);
                }
                // header('location: ./cart.php');
                break;
            case "update_cart";
                if (isset($_POST['update_button'])) {
                    // echo "update";
                    // exit;
                    // var_dump($_POST);
                    // exit;
                    update_cart();


                    // header('location: ./cart.php');
                } elseif (isset($_POST['order_button'])) {



                    if (empty($_POST['uName'])) {
                        $error = "Input name";
                    } elseif (empty($_POST['uAddress'])) {
                        $error = "Input Addrees";
                    } elseif (empty($_POST['uPhone'])) {
                        $error = "Input Phone";
                    } elseif (empty($_POST['quantity'])) {
                        $error = "Cart NUll";
                    }
                    if ($error == false && !empty($_POST['quantity'])) {


                        // xủ lý giỏ hàng lưu vào db
                        // var_dump($_POST);
                        // exit;

                        $cart_sql = "select * from products where p_id IN (" . implode(",", array_keys($_POST["quantity"])) . ")";
                        $result = mysqli_query($link, $cart_sql);
                        $total_cost = 0;


                        $orderProduct = array();
                        while ($row = mysqli_fetch_array($result)) {
                            $orderProduct[] = $row;
                            $total_cost += $row['p_price'] * $_POST['quantity'][$row['p_id']];
                        }
                        // echo date("d/m/y H:i", 1614411800);datetime show from db

                        $order = mysqli_query($link, "INSERT INTO `orders` (`id`, `name`, `address`, `phone`, `note`, `total`,`create_time`,`update_time`) VALUES (NULL, '$_POST[uName]', '$_POST[uAddress]', '$_POST[uPhone]', '$_POST[uNote]', '$total_cost', '" . time() . "','" . time() . "');");
                        $orderId = ($link->insert_id);

                        $insertString = "";


                        foreach ($orderProduct as $key => $product) {

                            $insertString .= "(NULL, '" . $orderId . "', '" . $product['p_id'] . "', '" . $_POST['quantity'][$product["p_id"]] . "', '" . $product['p_price'] . "', '" . time() . "', '" . time() . "')";
                            if ($key != count($orderProduct) - 1) {
                                $insertString .=  ",";
                            }
                            var_dump($insertString);
                        }

                        $orderDetail = mysqli_query($link, "INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `create_time`, `update_time`) VALUES " . $insertString . ";");
                        var_dump($orderDetail);
                        exit;
                        echo $success = "order thành công";
                        //log error sql
                        // var_dump(mysqli_error($link));
                        // exit;
                        unset($_SESSION['cart']);
                    }
                }
                break;
        }
    }
} else {

    header('location: ../account/login.php');
}
if (!empty($_SESSION["cart"])) {
    // var_dump(implode(",", array_keys($_SESSION["cart"])));
    // exit;
    $cart_sql = "select * from products where p_id IN (" . implode(",", array_keys($_SESSION["cart"])) . ")";
    $result = mysqli_query($link, $cart_sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="../library/js/mobiscroll.javascript.min.js"></script>
    <!-- font-cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <!-- bootstrap 4 cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jquery 4 cdn -->
    <L src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></L>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/cart.css">


</head>

<body>
    <hr>
    <p style="background: #e6e6e6; padding: 10px; border-left: 5px solid blue; font-weight: bold; font-size: 18px;">Your Cart</p>
    <div>
        <button type="submit" class="btn btn-dark" name="cancel" style="font-style: italic; color: blue; float: left;">Cancel the shopping cart</button>
    </div>
    <?php
    if (isset($_POST['cancle'])) {
        unset($_SESSION['cart']);
    ?>
        <script>
            window.location.href = "https://ciliweb.vn/ciliweb_project/user/index.php"
        </script>
    <?php
    }
    ?>
    <div>
        <button type="submit" class="btn btn-dark" style="font-style: italic; color: blue; float: right;" name="cancel"><a href="https://ciliweb.vn/ciliweb_project/user/index.php">Continue Buying</a></button>
    </div>

    <?php
    if (!empty($error)) {
    ?>
        <div><?= $error ?>. <a href="javascript:history.back()">Back</a></div>
    <?php
    } elseif (!empty($success)) {
    ?>
        <div><?= $success ?><a href="../index.php">Tiếp tục mua hàng</a></div>
    <?php
    } else {

    ?>

        <div>
            <div>
                <form action="cart.php?view=update_cart" method="post" enctype="multipart/form-data">

                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>Select</th>
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
                            if (!empty($result)) {
                                $total = 0;
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                            ?>

                                    <tr>
                                        <td><input type="checkbox" name="selectProduct" id="selectProduct"></td>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row['p_name'] ?></td>
                                        <td><img src="/ciliweb_project/admin/<?= $row['p_image'] ?>" width="60" height="70"></td>
                                        <td> <input type="number" value="<?= $_SESSION["cart"][$row["p_id"]] ?>" name="quantity[<?= $row['p_id'] ?>]"></td>
                                        <td><?= number_format($cost = $row['p_price'] * $_SESSION["cart"][$row["p_id"]], 0, ",", ".")   ?>VNĐ</td>
                                        <td><a href="cart.php?view=delete&id=<?= $row['p_id'] ?>">Delete</a></td>
                                    </tr>
                                <?php
                                    $total += $cost;
                                }
                                ?>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="totalCost">
                        <div style="float: right;">
                            <?php
                            if (!empty($total)) {
                            ?>
                                <span>Total cost</span>&emsp;&emsp;<span><?= number_format($total, 0, ",", ".") ?>VNĐ</span>
                            <?php
                            }
                            ?>

                        </div>

                    </div>

                    <div>
                        <input type="submit" class="btn btn-success" name="update_button" value="update"></input>
                    </div>
                    <br>
                    <div>
                        <input type="submit" class="btn btn-success" name="add_to_order" value="Add to Order"></input>
                    </div>
                    <br>
                    <hr>
                    <div id="orderForm" style="display: none">
                        <h1>Order Form</h1>
                        <div class="control-group">
                            <label class="control-label">Add name :</label>
                            <div class="controls">
                                <input type="text" class="span11" placeholder="Add name" name="uName" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Add address :</label>
                            <div class="controls">
                                <input type="text" class="span11" placeholder="Add address" name="uAddress" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Add phone :</label>
                            <div class="controls">
                                <input type="text" class="span11" placeholder="Add phone" name="uPhone" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Add Note :</label>
                            <div class="controls">
                                <textarea type="text" class="span11" placeholder="Add node" name="uNote"></textarea>
                            </div>
                        </div>

                        <div class="alert alert-danger" id="error" style="display:none">
                            <strong>The Product Already Exist! Please Try Another.</strong>
                        </div>
                        <div class="alert alert-success" id="success" style="display:none">
                            <strong>Record Inserted Successfully!</strong>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-success" name="order_button" value="order"></input>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-success" name="order_normal" value="order nomal"></input>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-success" name="order_online" value="order online"></input>
                        </div>
                    </div>
                </form>

            </div>
        </div> <?php
            }
                ?>
    <br>
    <br>

</body>

</html>




<?php
if (isset($_POST["order_online"])) {


    $_SESSION["username"] = $_POST["username"]
?>
    <script type="text/javascript">
        window.location = "../payment/vnpay_php/index.php";
    </script>
<?php
}



if (isset($_POST["order_normal"])) {


    $_SESSION["username"] = $_POST["username"]
?>
    <script type="text/javascript">
        window.location = "../cart/order.php";
    </script>
<?php
}

if (isset($_POST["add_to_order"])) {
?>
    <script type="text/javascript">
        document.getElementById("orderForm").style.display = "block";
    </script>
<?php

}

?>










































<?php
session_start();
include "../connect_db.php";
include "../header.php";


if (!isset($_SESSION["current_user"])) {

    $_SESSION["cart"] = $_SESSION["current_user"]['user_id']  = array();
}
if (!isset($_SESSION["current_user_social"])) {

    $_SESSION["cart"] = $_SESSION["current_user_social"]['user_id'] = array();
}
if (!empty($_SESSION["cart"])) {
    // var_dump(implode(",", array_keys($_SESSION["cart"])));
    // exit;
    $cart_sql = "select * from products where p_id IN (" . implode(",", array_keys($_SESSION["cart"])) . ")";
    $result = mysqli_query($link, $cart_sql);
}

// if (!empty($_SESSION["cart"])) {
//     // var_dump(implode(",", array_keys($_SESSION["cart"])));
//     // exit;
//     $cart_sql = "select * from cart where cart_user_id = 1";
//     $result = mysqli_query($link, $cart_sql);
// }

$error = false;
$success = false;
if (isset($_GET["view"])) {
    function update_cart($add = false)
    {
        foreach ($_POST['quantity'] as $id => $quantity) {

            if ($quantity == 0) {
                unset($_SESSION["cart"][$id]);
            } else {
                if (isset($add)) {
                    $_SESSION["cart"][$id] += $quantity;
                } else {
                    $_SESSION["cart"][$id] = $quantity;
                }
            }
        }
    }
    switch ($_GET['view']) {
        case "add_to_cart";
            update_cart($add = true);

            $cart_sql = "select * from products where p_id IN (" . implode(",", array_keys($_POST["quantity"])) . ")";
            $result = mysqli_query($link, $cart_sql);
            $cartProduct = array();
            while ($row = mysqli_fetch_array($result)) {
                $cartProduct[] = $row;
                $productId = $row['p_id'];
                $cartProductPrice = $row['p_price'];
            }

            $insertString = "";
            foreach ($cartProduct as $key => $product) {

                $insertString .= "(NULL, '" . ($_SESSION["current_user"]['user_id']) . "', '" . $product['p_id'] . "', '" . $_POST['quantity'][$product["p_id"]] . "', '" . $product['p_price'] . "', '" . time() . "', '" . time() . "')";
                if ($key != count($cartProduct) - 1) {
                    $insertString .=  ",";
                }
            }

            $cart_Compare = "select * from cart";
            $resultCart = mysqli_query($link, $cart_Compare);
            while ($row = mysqli_fetch_array($resultCart)) {
                $cartProductId = $row['cart_product_id'];
            }


            if ($cartProductId == $productId) {
                $cartDetail = mysqli_query($link, "UPDATE  `cart` SET  `cart_amount` = '" . $_POST['quantity'][$product["p_id"]] . "'");
            } else
                $cartDetail = mysqli_query($link, "INSERT INTO `cart` (`cart_id`, `cart_user_id`, `cart_product_id`, `cart_amount`, `cart_price`, `create_time`, `update_time`) VALUES " . $insertString . ";");

            echo $success = "add thành công";


            header('location: ./cart.php');
            break;
        case "delete";
            // var_dump($_SESSION["cart"]);
            // exit;
            // echo "delete";
            if (isset($_GET['id'])) {
                unset($_SESSION["cart"][$_GET['id']]);
            }
            header('location: ./cart.php');
            break;
        case "update_cart";
            if (isset($_POST['update_button'])) {
                // echo "update";
                // exit;
                // var_dump($_POST);
                // exit;
                update_cart();


                header('location: ./cart.php');
            } elseif (isset($_POST['order_button'])) {



                if (empty($_POST['uName'])) {
                    $error = "Input name";
                } elseif (empty($_POST['uAddress'])) {
                    $error = "Input Addrees";
                } elseif (empty($_POST['uPhone'])) {
                    $error = "Input Phone";
                } elseif (empty($_POST['quantity'])) {
                    $error = "Cart NUll";
                }
                if ($error == false && !empty($_POST['quantity'])) {


                    // xủ lý giỏ hàng lưu vào db
                    // var_dump($_POST);
                    // exit;

                    $cart_sql = "select * from products where p_id IN (" . implode(",", array_keys($_POST["quantity"])) . ")";
                    $result = mysqli_query($link, $cart_sql);
                    $total_cost = 0;


                    $orderProduct = array();
                    while ($row = mysqli_fetch_array($result)) {
                        $orderProduct[] = $row;
                        $total_cost += $row['p_price'] * $_POST['quantity'][$row['p_id']];
                    }
                    // echo date("d/m/y H:i", 1614411800);datetime show from db

                    $order = mysqli_query($link, "INSERT INTO `orders` (`id`, `name`, `address`, `phone`, `note`, `total`,`create_time`,`update_time`) VALUES (NULL, '$_POST[uName]', '$_POST[uAddress]', '$_POST[uPhone]', '$_POST[uNote]', '$total_cost', '" . time() . "','" . time() . "');");
                    $orderId = ($link->insert_id);

                    $insertString = "";


                    foreach ($orderProduct as $key => $product) {

                        $insertString .= "(NULL, '" . $orderId . "', '" . $product['p_id'] . "', '" . $_POST['quantity'][$product["p_id"]] . "', '" . $product['p_price'] . "', '" . time() . "', '" . time() . "')";
                        if ($key != count($orderProduct) - 1) {
                            $insertString .=  ",";
                        }
                    }

                    $orderDetail = mysqli_query($link, "INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `create_time`, `update_time`) VALUES " . $insertString . ";");

                    echo $success = "order thành công";
                    //log error sql
                    // var_dump(mysqli_error($link));
                    // exit;
                    unset($_SESSION['cart']);
                }
            }
            break;
    }
}

?>


<hr>
<p style="background: #e6e6e6; padding: 10px; border-left: 5px solid blue; font-weight: bold; font-size: 18px;">Your Cart</p>
<div>
    <button type="submit" class="btn btn-dark" name="cancel" style="font-style: italic; color: blue; float: left;">Cancel the shopping cart</button>
</div>
<div>
    <button type="submit" class="btn btn-dark" style="font-style: italic; color: blue; float: right;" name="cancel"><a href="https://ciliweb.vn/ciliweb_project/user/index.php">Continue Buying</a></button>
</div>

<?php
if (!empty($error)) {
?>
    <div><?= $error ?>. <a href="javascript:history.back()">Back</a></div>
<?php
} elseif (!empty($success)) {
?>
    <div><?= $success ?><a href="../index.php">Tiếp tục mua hàng</a></div>
<?php
} else {

?>

    <div>
        <div>
            <form action="cart.php?view=update_cart" method="post" enctype="multipart/form-data">

                <table class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Select</th>
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
                        if (!empty($result)) {
                            $total = 0;
                            $i = 1;
                            while ($row = mysqli_fetch_array($result)) {
                        ?>

                                <tr>
                                    <td><input type="checkbox" name="selectProduct" id="selectProduct"></td>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['p_name'] ?></td>
                                    <td><img src="/ciliweb_project/admin/<?= $row['p_image'] ?>" width="60" height="70"></td>
                                    <td> <input type="number" value="<?= $_SESSION["cart"][$row["p_id"]] ?>" name="quantity[<?= $row['p_id'] ?>]"></td>
                                    <td><?= number_format($cost = $row['p_price'] * $_SESSION["cart"][$row["p_id"]], 0, ",", ".")   ?>VNĐ</td>
                                    <td><a href="cart.php?view=delete&id=<?= $row['p_id'] ?>">Delete</a></td>
                                </tr>
                            <?php
                                $total += $cost;
                                $i++;
                            }
                            ?>
                            <tr>
                                <th>Tổng tiền</th>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?= number_format($total, 0, ",", ".") ?>VNĐ</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div>
                    <input type="submit" class="btn btn-success" name="update_button" value="update"></input>
                </div>
                <br>
                <div>
                    <input type="submit" class="btn btn-success" name="add_to_order" value="Add to Order"></input>
                </div>
                <br>
                <hr>
                <div id="orderForm" style="display: none">
                    <h1>Order Form</h1>
                    <div class="control-group">
                        <label class="control-label">Add name :</label>
                        <div class="controls">
                            <input type="text" class="span11" placeholder="Add name" name="uName" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Add address :</label>
                        <div class="controls">
                            <input type="text" class="span11" placeholder="Add address" name="uAddress" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Add phone :</label>
                        <div class="controls">
                            <input type="text" class="span11" placeholder="Add phone" name="uPhone" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Add Note :</label>
                        <div class="controls">
                            <textarea type="text" class="span11" placeholder="Add node" name="uNote"></textarea>
                        </div>
                    </div>

                    <div class="alert alert-danger" id="error" style="display:none">
                        <strong>The Product Already Exist! Please Try Another.</strong>
                    </div>
                    <div class="alert alert-success" id="success" style="display:none">
                        <strong>Record Inserted Successfully!</strong>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-success" name="order_button" value="order"></input>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-success" name="order_normal" value="order nomal"></input>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-success" name="order_online" value="order online"></input>
                    </div>
                </div>
            </form>

        </div>
    </div> <?php
        }
            ?>
<br>
<br>
<?php
if (isset($_POST["order_online"])) {


    $_SESSION["username"] = $_POST["username"]
?>
    <script type="text/javascript">
        window.location = "../payment/vnpay_php/index.php";
    </script>
<?php
}



if (isset($_POST["order_normal"])) {


    $_SESSION["username"] = $_POST["username"]
?>
    <script type="text/javascript">
        window.location = "../cart/order.php";
    </script>
<?php
}

if (isset($_POST["add_to_order"])) {
?>
    <script type="text/javascript">
        document.getElementById("orderForm").style.display = "block";
    </script>
<?php

}

?>