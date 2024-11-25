<?php
    include 'connect_db.php';
    session_start(); 
    $errorContainer= array(); 
    $email= $_POST['email']; 
    $password= $_POST['first_password'];  

    $passwordQuery="SELECT password FROM users WHERE email='$email'";
    $saltQuery="SELECT salt FROM users WHERE email='$email'";
    $passwordResult = mysqli_query($conn, $passwordQuery) or die("Ошибка выполнения запроса" . mysqli_error($conn));
    $saltResult= mysqli_query($conn, $saltQuery) or die("Ошибка выполнения запроса" . mysqli_error($conn));
    if($passwordResult && $saltResult) {
        $passworsRow= mysqli_fetch_row($passwordResult);
        $saltRow= mysqli_fetch_row($saltResult);
        if(md5(md5($password).$saltRow[0]) == $passworsRow[0]) {
            $userExists= true;
        } else{
            $userExists= false;
            print "<script language='Javascript' type='text/javascript'> 
                    alert('Такого пользователя не существует!');
                    function reload(){
                        top.location= '../../partials/forms/login.php'; 
                    }
                    reload();  
                </script>";
        }
        if($userExists) {
            $nameQuery="SELECT id,name,email,phone FROM users WHERE email='$email'";
            $nameResult= mysqli_query($conn, $nameQuery) or die("Ошибка выполнения запроса" . mysqli_error($conn));
            if($nameResult) {
                $nameRow = mysqli_fetch_assoc($nameResult); 
                session_start(); 
                $arrayFields = array(
                    'name' => $nameRow['name'],
                    'email' => $nameRow['email'],
                    'phone' => $nameRow['phone']
                );
                $_SESSION['id_user'] =  $nameRow['id'];
                $_SESSION['userData'] = $arrayFields;
            }
            print "<script language='Javascript' type='text/javascript'> 
                    alert(`Вы успешно вошли в аккаунт!`); 
                    function reload(){
                        top.location= '../../partials/account/account_body.php'; 
                    }
                    reload(); 
                </script>";
        }
    }
