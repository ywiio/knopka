<?php
include 'connect_db.php';
session_start();
$errorContainer = array();
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$salt = mt_rand(100, 999);
$new_pass = md5(md5($new_password) . $salt);

$id_user = $_SESSION['id_user'];

$passwordQuery = "SELECT password FROM users WHERE id='$id_user'";
$saltQuery = "SELECT salt FROM users WHERE id='$id_user'";
$passwordResult = mysqli_query($conn, $passwordQuery) or die("Ошибка выполнения запроса" . mysqli_error($conn));
$saltResult = mysqli_query($conn, $saltQuery) or die("Ошибка выполнения запроса" . mysqli_error($conn));

if ($passwordResult && $saltResult) {
    $passworsRow = mysqli_fetch_row($passwordResult);
    $saltRow = mysqli_fetch_row($saltResult);
    if (md5(md5($old_password) . $saltRow[0]) == $passworsRow[0]) {
        $query = "UPDATE users SET name = '$name', email = '$email', password = '$new_pass', phone = '$phone', salt = '$salt' WHERE id = '$id_user'";
        $result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn));

        if ($result) {
            $query = "SELECT* FROM users WHERE name='$name'";
            $rez = mysqli_query($conn, $query);
            if ($rez) {
                $row = mysqli_fetch_assoc($rez);
                $_SESSION['id_user'] = $row['id'];
                mysqli_close($conn);
                print "<script language='Javascript' type='text/javascript'> 
                    alert('Данные успешно обновлены!'); 
                    function reload(){top.location= 'account_body.php'}; 
                    reload(); 
                    </script>";
            }
        }
    } else {
        print "<script language='Javascript' type='text/javascript'> 
                    alert('Ошибка! Введите соответствующие данные!'); 
                    function reload(){top.location= 'account_body.php'}; 
                    reload(); 
                    </script>";
    }
}
