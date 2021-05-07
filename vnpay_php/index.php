<?php
include "../config_user.php";

$GLOBALS['checkout_infor'] = ($_SESSION["checkout_infor"]);
$GLOBALS['cost_online'] = ($_SESSION["cost-online"]);

if (!isset($resultUserInfor)) {
    $resultUserInfor = mysqli_query($link, "SELECT  user.*, user_infor.*  from user_infor INNER JOIN user ON user.user_id = user_infor.ui_user_id WHERE `user_id` = '$userId'");
}
if (isset($resultUserInfor)) {
    $rowUser = mysqli_fetch_array($resultUserInfor, MYSQLI_ASSOC);
}

// var_dump($GLOBALS['cost_online']);
// exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <!-- font-cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <!-- bootstrap 4 cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jquery 4 cdn -->
    <L src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></L>

    <!-- Custom styles for this template -->

    <!-- Custom styles for this template -->
    <?php
    include "../partials/html_header.php";
    include "../payment/header_payment.php"
    ?>

</head>

<body style="background: #edf2f9;">


    <div class="container" style="margin-top: 150px;">
        <div class="card">
            <div class="card-header">
                <div class="header clearfix m-t-30">
                    <h1 class="text-muted text-center " style="color:red  !important;">Proceed to pay for your order.</h1>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-d-30">
                    <form action="../vnpay_php/vnpay_create_payment.php" id="create_form" method="post">
                        <div class="form-group">
                            <label for="language">Commodity </label>
                            <select name="order_type" id="order_type" class="form-control">
                                <option value="billpayment">Pay the bill</option>
                                <option value="other">Others - Read more at VNPAY</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="order_id">Code Bill</label>
                            <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount of money</label>
                            <input class="form-control" id="amount" name="amount" type="text" value="<?php echo $GLOBALS['cost_online'], " VNĐ" ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label for="order_desc">Content billing</label>
                            <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Online payment for orders at the CILI e-commerce website</textarea>
                        </div>
                        <div class="form-group">
                            <label for="bank_code">Bank</label>
                            <select name="bank_code" id="bank_code" class="form-control">
                                <option value="">Not slect</option>
                                <option value="NCB"> Ngan hang NCB</option>
                                <option value="AGRIBANK"> Ngan hang Agribank</option>
                                <option value="SCB"> Ngan hang SCB</option>
                                <option value="SACOMBANK">Ngan hang SacomBank</option>
                                <option value="EXIMBANK"> Ngan hang EximBank</option>
                                <option value="MSBANK"> Ngan hang MSBANK</option>
                                <option value="NAMABANK"> Ngan hang NamABank</option>
                                <option value="VNMART"> Vi dien tu VnMart</option>
                                <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                <option value="HDBANK">Ngan hang HDBank</option>
                                <option value="DONGABANK"> Ngan hang Dong A</option>
                                <option value="TPBANK"> Ngân hàng TPBank</option>
                                <option value="OJB"> Ngân hàng OceanBank</option>
                                <option value="BIDV"> Ngân hàng BIDV</option>
                                <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                <option value="VPBANK"> Ngan hang VPBank</option>
                                <option value="MBBANK"> Ngan hang MBBank</option>
                                <option value="ACB"> Ngan hang ACB</option>
                                <option value="OCB"> Ngan hang OCB</option>
                                <option value="IVB"> Ngan hang IVB</option>
                                <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="language">Language</label>
                            <select name="language" id="language" class="form-control">
                                <option value="vn">Tiếng Việt</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary text-center" id="btnPopup">Payment Popup</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <p>
            &nbsp;
        </p>
        <!-- <footer class="footer">
            <p>&copy; VNPAY 2015</p>
        </footer> -->
    </div>

    <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet" />
    <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
    <script type="text/javascript">
        $("#btnPopup").click(function() {
            var postData = $("#create_form").serialize();
            var submitUrl = $("#create_form").attr("action");
            $.ajax({
                type: "POST",
                url: submitUrl,
                data: postData,
                dataType: 'JSON',
                success: function(x) {
                    if (x.code === '00') {
                        if (window.vnpay) {
                            vnpay.open({
                                width: 768,
                                height: 600,
                                url: x.data
                            });
                        } else {
                            location.href = x.data;
                        }
                        return false;
                    } else {
                        alert(x.Message);
                    }
                }
            });
            return false;
        });
    </script>


</body>

</html>