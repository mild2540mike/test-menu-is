<?php

    $host = "localhost";
    $username = "root";
    $password = "root123456";
    $db_name = "restaurant";

    $con = mysqli_connect($host, $username, $password, $db_name);

    if(!$con) {
        die("Cannot connect to the database");
    }
    mysqli_query($con,"SET NAMES UTF8");
    date_default_timezone_set('Asia/Bangkok');
?>