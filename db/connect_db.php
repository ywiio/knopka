<?php
    $host= "localhost";
    $database = "knopka_db";
    $user= "root";
    $password= "";

    // $conn = new mysqli($host, $user, $password, $database);
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    $conn = mysqli_connect($host, $user, $password, $database) or die("Error" . mysqli_error($conn));
    $conn->set_charset('utf8');