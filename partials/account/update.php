<?php
    require 'connect_db.php';
    session_start();
    
    $errorContainer= array();
    $arrayFields= array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'old_password' => $_POST['old_password'],
        'new_password' => $_POST['new_password']
    );

    $id_user=$_SESSION['id_user'];

    foreach($arrayFields as $fieldName=> $oneField){
        if($oneField== '' || !isset($oneField)){
            $errorContainer[$fieldName] = "Поле обязательно для заполнения";
        }
    }
    if(!preg_match('/^[a-zа-я\d]{2,50}$/ui', $arrayFields['name'])) {
        $errorContainer['name'] = "Имя не соответствует требованиям";
    }
    
    if(!preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i', $arrayFields['email'])) {
        $errorContainer['email'] = "Почта не соответствует требованиям";
    }
    if(!preg_match('/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/', $arrayFields['phone'])) {
        $errorContainer['phone'] = "Телефон не соответствует требованиям";
    }

    $passwordQuery="SELECT password FROM users WHERE id='$id_user'";
    $saltQuery="SELECT salt FROM users WHERE id='$id_user'";
    $passwordResult = mysqli_query($conn, $passwordQuery) or die("Ошибка выполнения запроса" . mysqli_error($conn));
    $saltResult= mysqli_query($conn, $saltQuery) or die("Ошибка выполнения запроса" . mysqli_error($conn));

    if($passwordResult && $saltResult){
        $passworsRow= mysqli_fetch_row($passwordResult);
        $saltRow= mysqli_fetch_row($saltResult);
        if(md5(md5($arrayFields['old_password']).$saltRow[0]) != $passworsRow[0]) {
            $errorContainer['old_password'] = 'Пароли не совпадают';
        }
    }

    if (empty($errorContainer)) {
        echo json_encode(array('result' => 'success'));
        $_SESSION['userData'] = $arrayFields;
    } else {
        echo json_encode(array('result' => 'error', 'text_error' => $errorContainer));
    }

    