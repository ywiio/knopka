<?php
$host = "localhost";
$database = "knopka_db";
$user = "root";
$password = "";

$conn = mysqli_connect($host, $user, $password, $database) or die("Error" . mysqli_error($conn));
$conn->set_charset('utf8');

