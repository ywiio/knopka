<?php
    include 'connect_db.php';
    session_start();
    
    if(empty($_SESSION['id_user'])){
        print"<script language='Javascript' type='text/javascript'> 
            alert('Вы не вошли в аккаунт!'); 
            function reload(){top.location= '/forms/login.php'}; 
            reload(); </script>";
    }
    else{
        $id_user =$_SESSION['id_user'];
    }   

    $id_pet = $_POST['id_pet'];
    $$img_src=$_POST['img_src'];

    if ($img_src=="/img/heart_sticker_bl_full.svg") {
        echo "успешно добавлено";
        $sql_insert = "INSERT INTO favorites (id, id_user, id_pet) VALUES ('$id_user', '$id_pet')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "успешно добавлено";
        } else {
            echo "ошибка";
            echo "ошибка: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        $sql_delete = "DELETE FROM favorites WHERE id_user = '$id_user' and id_pet = '$id_pet'";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Карточка товару успішно видалена з бази даних";
        } else {
            echo "Помилка: " . $sql_delete . "<br>" . $conn->error;
        }
    }

    

    $conn->close();