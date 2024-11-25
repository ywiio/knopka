<?php
include 'connect_db.php';
session_start();
$errorContainer = array();
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$first_password = $_POST['first_password'];
$second_password = $_POST['second_password'];
$salt = mt_rand(100, 999);
$password = md5(md5($first_password) . $salt);

$query = "INSERT INTO users (name, email, password, phone, salt) VALUES ('$name','$email','$password','$phone','$salt')";
$result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn));

if ($result) {
    $query = "SELECT* FROM users WHERE name='$name'";
    $rez = mysqli_query($conn, $query);
    if ($rez) {
        $row = mysqli_fetch_assoc($rez);
        $_SESSION['id_user'] = $row['id'];
        mysqli_close($conn);
        print "<script language='Javascript' type='text/javascript'> 
            alert('Вы успешно зарегистрировались! Спасибо!'); 
            function reload(){top.location= '/partials/account/account_body.php'}; 
            reload(); 
            </script>";
    }
}
