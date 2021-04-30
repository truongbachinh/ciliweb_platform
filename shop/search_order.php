<?php
include "../config_shop.php";
$shopIF = $GLOBALS['shopInfor'];
$shopId = $shopIF['shop_id'];
$res = $link->query("SELECT orders.*,user.*,order_address.* from orders INNER JOIN order_address ON orders.id = order_address.oda_order_id INNER JOIN user ON user.user_id = orders.order_user_id where order_shop_id  = $shopId AND order_address.oda_lastname LIKE '%" . $_POST["search"] . "%' order by `id`  ");
if (mysqli_num_rows($res) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($res)) {
        $output .= ' <tr>
                        <td>' . $i++ . ' </td>
                        <td>' . $row["username"] . ' </td>
                        <td>' . $row["oda_firstname"] . " " . $row["oda_lastname"] . '</td>
                        <td>' . $row["oda_phone"] . '  </td>
                        <td>' . $row["oda_address"] . '  </td>
                        <td>' . $row["order_total_cost"] . '  </td>
                        <td>' . $row["order_total_amount"] . '  </td>  
                      
                       
                        <tr>';
    }


    echo $output;
} else {
    echo "data not found";
}
