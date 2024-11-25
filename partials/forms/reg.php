<?php
    require 'connect_db.php';
    session_start();
    
    $errorContainer= array();
    $arrayFields= array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'first_password' => $_POST['first_password'],
        'second_password' => $_POST['second_password']
    );

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
    else{
        $emailQuery="SELECT id FROM users WHERE email='{$arrayFields["email"]}'";
        $emailResult= mysqli_query($conn, $emailQuery) or die("Ошибка выполнения запроса" . mysqli_error($conn));
        if($emailResult) {
            $row= mysqli_fetch_row($emailResult);
            if(!empty($row[0])) $errorContainer['email'] = "Пользователь с данной почтой уже существует";
        }
    }
    if(!preg_match('/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/', $arrayFields['phone'])) {
        $errorContainer['phone'] = "Телефон не соответствует требованиям";
    }
    if($arrayFields['first_password'] != $arrayFields['second_password']) {
        $errorContainer['second_password'] = 'Пароли не совпадают';
    }
    if (empty($errorContainer)) {
        echo json_encode(array('result' => 'success'));
        $_SESSION['userData'] = $arrayFields;
    } else {
        echo json_encode(array('result' => 'error', 'text_error' => $errorContainer));
    }

    