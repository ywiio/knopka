<?php
    require 'connect_db.php';
    $errorContainer= array();
    $arrayFields= array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'file' => $_POST['file']
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
    }
    if (empty($errorContainer)) {
        echo json_encode(array('result' => 'success'));
    } else {
        echo json_encode(array('result' => 'error', 'text_error' => $errorContainer));
    }

    