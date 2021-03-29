<?php
$link = mysqli_connect("localhost", "root", "", "ciliweb_database");
$db_selected = mysqli_select_db($link, "ciliweb_database");
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Online Exam</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="..library/css/bootstrap.min.css">
    <link rel="stylesheet" href="..library/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">


</head>

<body>



    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
                        <div class="row">

                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 text-right">
                                <ul class="breadcome-menu">
                                    <li>
                                        <div id="countdowntimer" style="display: block;"></div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        setInterval(function() {
            timer();
        }, 1000);

        function timer() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    if (xmlhttp.responseText == "00:00:01") {
                        window.location = "result.php";
                    }

                    document.getElementById("countdowntimer").innerHTML = xmlhttp.responseText;

                }
            };
            xmlhttp.open("GET", "extend/load_timer.php", true);
            xmlhttp.send(null);
        }
    </script>