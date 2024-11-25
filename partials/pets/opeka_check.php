<?php
    include 'connect_db.php';
    session_start();

    $name= $_POST['name']; 
    $email= $_POST['email']; 
    $phone= $_POST['phone']; 
    $comm=$_POST['comm'];
    $id_pet=$_POST['id_pet'];

    $fileContent = file_get_contents($_FILES['file']['tmp_name']);

    if(!empty($_SESSION['id_user'])){
        $id_user =$_SESSION['id_user'];
    }else {
        echo "Результат не найден";
    }

    $stmt = $conn->prepare("INSERT INTO request (id_user, id_pet, file, comm) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $id_user, $id_pet, $fileContent, $comm);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        print"<script language='Javascript' type='text/javascript'> 
            alert('Ваш запрос принят! Ожидайте письмо с ответом на почту.'); 
            function reload(){top.location= '/index.php'}; 
            reload(); </script>";
    } else {
        print"<script language='Javascript' type='text/javascript'> 
            alert('Ошибка отправки заявки'); 
            function reload(){top.location= '/index.php'}; 
            reload(); </script>";
    }

    $stmt->close();
    $conn->close();
