<?php
$conn = mysqli_connect("localhost", "root", "", "ciliweb_database");
$db_selected = mysqli_select_db($conn, "ciliweb_database");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$vnp_TmnCode = "VDISOMUV"; //Mã website tại VNPAY 
$vnp_HashSecret = "TRREGZUOKLOUAMRTJAWEJBYSUNURXGNA"; //Chuỗi bí mật
$vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "https://ciliweb.vn/ciliweb_project/user/payment/vnpay_php/vnpay_return.php";
