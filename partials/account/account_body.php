<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="/css/account.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/scripts/loads_scripts.js"></script>
    <title>Knopka</title>
</head>

<body>
    <div class="container">
        <?php require "../header.php" ?>
        <?php
        include "../../db/connect_db.php";
        session_start();
        ?>

        <main class="account">
            <div class="account__switch">
                <div id="personal_data" onclick="loadAccBlock('personal_data')">
                    <p>Личные данные</p>
                    <img src="/img/person_icon.svg" alt="person">
                </div>
                <div id="subscribes" onclick="loadAccBlock('subscribes')">
                    <p>Подписки</p>
                    <img src="/img/dollar_icon_bl.svg" alt="dollar">
                </div>
                <div id="favorites" onclick="loadAccBlock('favorites')">
                    <p>Избранное</p>
                    <img src="/img/heart_sticker_bl.svg" alt="like">
                </div>
            </div>
            <div class="account__info" id="info">
                <?php
                if (!empty($_SESSION['id_user'])) {
                    echo '<form action="update_check.php" method="post" class="form">';
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
                    echo '  <input type="password" id="old_password" name="old_password" required placeholder="********">';
                    echo '  <span class="error" id="old_password_error"></span>';
                    echo '</div>';
                    echo '<div>';
                    echo '  <label for="new_password">Новый пароль</label>';
                    echo '  <input type="password" id="new_password" name="new_password" required placeholder="********">';
                    echo '  <span class="error" id="new_password_error"></span>';
                    echo '</div>';
                    echo '<input type="submit" class="account__info-btn" id="send_data" value="Обновить данные" disabled></input>';
                    echo '</form>';
                    echo '<form method="post">';
                    echo '<button onclick="logoutAndClearSession()" class="account__info-btn">Выйти из аккаунта</button>';
                    echo "</form>";
                } else {
                    echo "Войдите в аккаунт";
                }
                ?>
            </div>
        </main>
    </div>
    <?php require '../footer.php' ?>
    <?php
    $conn->close();
    ?>
    <script>
        function logoutAndClearSession() {
            $.ajax({
                type: 'POST',
                url: 'exit.php',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Вы успешно вышли из аккаунта и сессия очищена.');
                        $('.account__info').html(response);
                    } else {
                        alert('Произошла ошибка при выходе из аккаунта.');
                    }
                }
            });
        };



        $('input').bind('blur', function(e) {
            $('input').each(function() {
                $(this).removeClass('error_input');
            });
            $('.error').hide();

            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var old_password = $('#old_password').val();
            var new_password = $('#new_password').val();

            $.ajax({
                type: "POST",
                url: "update.php",
                data: {
                    'name': name,
                    'email': email,
                    'phone': phone,
                    'old_password': old_password,
                    'new_password': new_password
                },
                dataType: "json",
                success: function(data) {
                    if (data.result == 'success') {
                        // alert("good");
                        $('input[type="submit"]').attr('disabled', false);
                    } else {
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
                }
            });
            return false;
        });
    </script>
</body>

</html>