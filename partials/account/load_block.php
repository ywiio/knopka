<?php
include "../../db/connect_db.php";
session_start();

$div = $_GET['div'];

if ($div=='personal_data') {
    if (!empty($_SESSION['id_user'])) {
        echo '<form action="update_check.php" method="post" class="form" enctype="multipart/form-data">';
        echo '<div>';
        echo '  <label for="name">Имя</label>';
        echo '  <input type="text" id="name" name="name" value=\'';
        $name = !empty($_SESSION['userData']['name']) ? $_SESSION['userData']['name'] : "";
        echo $name;
        echo '\' required placeholder="Имя">';
        echo '  <span class="error" id="name_error"></span>';
        echo '</div>';
        echo '<div>';
        echo '  <label for="email">Email</label>';
        echo '  <input type="text" id="email" name="email" value=\'';
        $email = !empty($_SESSION['userData']['email']) ? $_SESSION['userData']['email'] : "";
        echo $email;
        echo '\' required placeholder="priut@google.com">';
        echo '  <span class="error" id="email_error"></span>';
        echo '</div>';
        echo '<div>';
        echo '  <label for="phone">Телефон</label>';
        echo '  <input type="text" id="phone" name="phone" value=\'';
        $phone = !empty($_SESSION['userData']['phone']) ? $_SESSION['userData']['phone'] : "";
        echo $phone;
        echo '\' required placeholder="+375 (XX) XXX-XX-XX">';
        echo '  <span class="error" id="phone_error"></span>';
        echo '</div>';
        echo '<div>';
        echo '  <label for="old_password">Ведите старый пароль</label>';
        echo '  <input type="text" id="old_password" name="old_password" required placeholder="********">';
        echo '  <span class="error" id="old_password_error"></span>';
        echo '</div>';
        echo '<div>';
        echo '  <label for="new_password">Новый пароль</label>';
        echo '  <input type="text" id="new_password" name="new_password" required placeholder="********">';
        echo '  <span class="error" id="new_password_error"></span>';
        echo '</div>';
        echo '<input type="submit" class="account__info-btn" id="send_data" value="Обновить данные"></input>';
        echo '</form>';
        echo '<form method="post">';
        echo '<button onclick="logoutAndClearSession()" class="account__info-btn">Выйти из аккаунта</button>';
        echo "</form>";
    } else {
        echo "Войдите в аккаунт";
    }
}
else if ($div=='subscribes') {
    
}
else if ($div=='favorites') {
    echo '<div class="account__catalog">';
    $id_user = $_SESSION['id_user'];

    $sql = "SELECT * FROM favorites JOIN pets ON favorites.id_pet = pets.id 
                    INNER JOIN gender ON pets.gender_fk = gender.gender_id
                    WHERE favorites.id_user = '$id_user'";
    $pets = $conn->query($sql);

    foreach ($pets as $pet) {
        echo '<div id=' . $pet['id'] . '" class="account__catalog-card">';
        if (!empty($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user'];
            $id_pet = $pet['id'];
            $query_likes = "SELECT * FROM favorites WHERE id_pet='$id_pet' AND id_user='$id_user'";
            $result_likes = mysqli_query($conn, $query_likes) or die("Ошибка " . mysqli_error($conn));
            $row_likes = mysqli_fetch_row($result_likes);
            if ($row_likes) {
                echo '<div class="account__catalog-card-like account__catalog-card-like-' . $id_pet . '"><img src="/img/like_icon_full.svg" onclick="del_like(' . $id_pet . ',' . $id_user . ')" ></img></div>';
            } else {
                echo '<div class="account__catalog-card-like account__catalog-card-like-' . $id_pet . '"><img src="/img/like_icon.svg" onclick="set_like(' . $id_pet . ',' . $id_user . ')" ></img></div>';
            }
        }
        echo '<a href="/partials/pets/pet_body.php?petID=' . $pet['id'] . '">';
        echo '<img src="' . $pet['img'] . '" alt="' . $pet['name'] . '">';
        echo '<div class="account__catalog-card-info">';
        echo '<h4>' . $pet['name'] . ',</h4>';
        echo '<p>' . $pet['gender'] . '<br>' . $pet['age'] . '</p>';
        echo '</div>';
        echo '<button class="account__catalog-card-btn-arrow" action="">';
        echo '<div></div>';
        echo '</button>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
}
