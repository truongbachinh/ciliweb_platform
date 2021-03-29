<?php

$server = 'localhost';
$db = 'ciliweb_database';
$username = 'root';
$password = '';
$conn = mysqli_connect($server, $username, $password, $db);
mysqli_set_charset($conn, 'UTF8');
mysqli_select_db($conn, $db);
