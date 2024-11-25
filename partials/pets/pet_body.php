<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/css/pet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/scripts/loads_scripts.js"></script>
    <title>Knopka</title>
</head>

<body>
    <div class="container">
        <?php
        require "../header.php";
        require '../../db/connect_db.php';
        session_start();
        $petID = $_GET['petID'];

        $sql = "SELECT * FROM pets 
                            INNER JOIN gender ON gender.gender_id = pets.gender_fk
                            INNER JOIN wool_info ON wool_info.wool_info_id = pets.wool_info_fk
                            INNER JOIN size ON size.size_id = pets.size_fk
                            WHERE pets.id = $petID";
        $result = $conn->query($sql);
        ?>
        <main class="pet">
            <div class="pet__info">
                <div class="pet__info-slider">
                    <?php
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        echo '<img src="' . $row["img"] . '" alt="' . $row["name"] . '">';
                        echo '</div>';
                        echo ' <div class="pet__info-block">';
                        if (!empty($_SESSION['id_user'])) {
                            $id_user = $_SESSION['id_user'];
                            $query_likes = "SELECT * FROM favorites WHERE id_pet='$petID' AND id_user='$id_user'";
                            $result_likes = mysqli_query($conn, $query_likes) or die("Ошибка " . mysqli_error($conn));
                            $row_likes = mysqli_fetch_row($result_likes);
                            if ($row_likes) {
                                echo '<div class="like"><img src="/img/heart_sticker_bl_full.svg" class="pet__info-block-like" onclick="del_like(' . $petID . ',' . $id_user . ')" ></img></div>';
                            } else {
                                echo '<div class="like"><img src="/img/heart_sticker_bl.svg" class="pet__info-block-like" onclick="set_like(' . $petID . ',' . $id_user . ')" ></img></div>';
                            }
                        }
                        echo "<h2>" . $row["name"] . "</h2>";
                        echo '<div class="pet__info-block-tags">';

                        echo '<div class="pet__info-block-tags-tag">';
                        echo '<div>';
                        echo '<img src="/img/age_icon.png" alt="calendar">';
                        echo '<p>Возраст</p>';
                        echo '</div>';
                        echo '<p>' . $row["age"] . '</p>';
                        echo '</div>';

                        echo '<div class="pet__info-block-tags-tag">';
                        echo '<div>';
                        echo '<img src="/img/gender_icon.png" alt="gender">';
                        echo '<p>Пол</p>';
                        echo '</div>';
                        echo '<p>' . $row["gender"] . '</p>';
                        echo '</div>';

                        echo '<div class="pet__info-block-tags-tag">';
                        echo '<div>';
                        echo '<img src="/img/weight_icon.png" alt="weight">';
                        echo '<p>Вес</p>';
                        echo '</div>';
                        echo '<p>' . $row["weight"] . ' кг</p>';
                        echo '</div>';

                        echo '<div class="pet__info-block-tags-tag">';
                        echo '<div>';
                        echo '<img src="/img/character_icon.png" alt="character">';
                        echo '<p>Характер</p>';
                        echo '</div>';
                        echo '<p>' . $row["pet_character"] . '</p>';
                        echo '</div>';

                        echo '<div class="pet__info-block-tags-tag">';
                        echo '<div>';
                        echo '<img src="/img/size_icon.png" alt="size">';
                        echo '<p>Размер</p>';
                        echo '</div>';
                        echo '<p>' . $row["size"] . '</p>';
                        echo '</div>';

                        echo '<div class="pet__info-block-tags-tag">';
                        echo '<div>';
                        echo '<img src="/img/wool_icon.png" alt="wool">';
                        echo '<p>Шерсть</p>';
                        echo '</div>';
                        echo '<p>' . $row["wool_info"] . '</p>';
                        echo '</div>';

                        echo '<div class="pet__info-block-tags-tag">';
                        echo '<div>';
                        echo '<img src="/img/food_icon.png" alt="food">';
                        echo '<p>Кормление</p>';
                        echo '</div>';
                        echo '<p>' . $row["food_info"] . '</p>';
                        echo '</div>';

                        if ($row["vaccination"]) {
                            echo '<div class="pet__info-block-tags-tag vaccination">';
                            echo '<img src="/img/vaccination_icon.png" alt="vaccination">';
                            echo '<p>Вакцинирован(-а)</p>';
                            echo '</div>';
                        }

                        if ($row["treatment"]) {
                            echo '<div class="pet__info-block-tags-tag treatment">';
                            echo '<img src="/img/treatment_icon.png" alt="treatment">';
                            echo '<p>Обработан(-а) от паразитов </p>';
                            echo '</div>';
                        }

                        echo '</div>';
                    }
                    ?>
                    <button id="click-scroll">Познакомиться</button>
                </div>
            </div>
            <div class="pet__opeka">
                <div class="pet__opeka-title">
                    <h2>заявка</h2>
                    <img src="/img/pets_img/ayla.png" alt="tabi">
                    <h2>на</h2>
                    <img src="/img/pets_img/harvi.png" alt="tabi">
                    <h2>опеку</h2>
                </div>
                <?php
                if (!empty($_SESSION['id_user'])) {
                    echo '<form action="opeka_check.php" method="post" enctype="multipart/form-data">';
                    echo '<input type="hidden" id="id_pet" name="id_pet" value=' . $petID . '>';
                    echo '<div>';
                    echo '  <label for="name">Имя *</label>';
                    echo '  <input type="text" id="name" name="name" value=\'';
                    $name = !empty($_SESSION['userData']['name']) ? $_SESSION['userData']['name'] : "";
                    echo $name;
                    echo '\' required placeholder="Имя">';
                    echo '  <span class="error" id="name_error"></span>';
                    echo '</div>';
                    echo '<div>';
                    echo '  <label for="email">Email *</label>';
                    echo '  <input type="text" id="email" name="email" value=\'';
                    $email = !empty($_SESSION['userData']['email']) ? $_SESSION['userData']['email'] : "";
                    echo $email;
                    echo '\' required placeholder="priut@google.com">';
                    echo '  <span class="error" id="email_error"></span>';
                    echo '</div>';
                    echo '<div>';
                    echo '  <label for="phone">Телефон *</label>';
                    echo '  <input type="text" id="phone" name="phone" value=\'';
                    $phone = !empty($_SESSION['userData']['phone']) ? $_SESSION['userData']['phone'] : "";
                    echo $phone;
                    echo '\' required placeholder="+375 (XX) XXX-XX-XX">';
                    echo '  <span class="error" id="phone_error"></span>';
                    echo '</div>';
                    echo '<div>';
                    echo '  <label>Загрузите фото документов *</label>';
                    echo '  <label for="file" class="custom-file-upload">Нажмите сюда</label>';
                    echo '  <input name="file" id="file" type="file" required style="display:none;"/>';
                    echo '  <span class="error" id="file_error"></span>';
                    echo '</div>';
                    echo '<div>';
                    echo '  <label for="comm">Комментарий</label>';
                    echo '  <textarea type="text" id="comm" name="comm" placeholder="Ваш комментарий"></textarea>';
                    echo '</div>';
                    echo '<input type="submit" class="pet__opeka-btn" id="send_data" value="Отправить"></input>';
                    echo '</form>';
                } else {
                    echo "Вы не вошли в аккаунт!";
                }
                ?>
            </div>
        </main>
    </div>
    <?php require '../footer.php' ?>

    <script>
        $("#click-scroll").click(function() {
            $('html, body').animate({
                scrollTop: $(".pet__opeka").offset().top
            }, 1000);
        });

        $('input').bind('blur', function(e) {
            $('input').each(function() {
                $(this).removeClass('error_input');
            });
            $('.error').hide();

            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var file = $('#file').val();
            var id_pet = $('#id_pet').val();

            $.ajax({
                type: "POST",
                url: "opeka.php",
                data: {
                    'name': name,
                    'email': email,
                    'phone': phone,
                    'file': file
                },
                dataType: "json",
                success: function(data) {
                    if (data.result == 'success') {
                        $('input[type="submit"]').attr('disabled', false);
                    } else {
                        for (var errorField in data.text_error) {
                            $('#' + errorField + '_error').html(data.text_error[errorField]);
                            $('#' + errorField + '_error').show();
                            $('#' + errorField).addClass('error_input');
                            $('input[type="submit"]').attr('disabled', true);
                            return true;
                        }
                    }
                }
            });
            return false;
        });
        document.getElementById('file').onchange = function(e) {
            document.querySelector('.custom-file-upload').innerText = e.target.files[0].name || 'Нажмите сюда!';
        };
    </script>

    <?php
    $conn->close();
    ?>
</body>

</html>