<?php 
require "connect_db.php"; 
if (isset($_POST['id_pet']) and isset($_POST['id_user'])) { 
    $id_pet = $_POST['id_pet']; 
    $id_user = $_POST['id_user']; 
    $query = "INSERT INTO favorites (id_pet, id_user)  
        VALUES ('$id_pet','$id_user')"; 
    $result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn)); 
}

if (isset($_POST['id_pet_del']) and isset($_POST['id_user_del'])) { 
    $id_pet_del = $_POST['id_pet_del']; 
    $id_user_del = $_POST['id_user_del']; 
    $query = "DELETE FROM favorites WHERE id_pet ='$id_pet_del' AND id_user ='$id_user_del' "; 
    $result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn)); 
}