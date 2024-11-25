<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="/css/registration.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Knopka</title>
</head>

<body>
    <div class="container">
        <?php require "../header.php" ?>
        <div class="registration">
            <div class="registration__title">
                <h2>Регистрация</h2>
                <img src="/img/pets_img/tabi.png" alt="tabi">
            </div>

            <form action="registration_check.php" method="post" class="registration__form">
                <div class="registration__form-block">
                    <label for="name">Имя</label>
                    <input type="text" class="registration__form-block-input" id="name" name="name" value="<?= @$name; ?>" required placeholder="Имя">
                    <span class="error" id="name_error"></span>
                </div>

                <div class="registration__form-block">
                    <label for="email">Email</label>
                    <input type="text" class="registration__form-block-input" id="email" name="email" value="<?= @$email; ?>" required placeholder="priut@google.com">
                    <span class="error" id="email_error"></span>
                </div>

                <div class="registration__form-block">
                    <label for="phone">Телефон</label>
                    <input type="text" class="registration__form-block-input" id="phone" name="phone" value="<?= @$phone; ?>" required placeholder="+375 (XX) XXX-XX-XX">
                    <span class="error" id="phone_error"></span>
                </div>

                <div class="registration__form-block">
                    <label for="first_password">Пароль</label>
                    <input type="text" class="registration__form-block-input" id="first_password" name="first_password" required placeholder="Минимум 8 символов">
                    <span class="error" id="first_password_error"></span>
                </div>

                <div class="registration__form-block">
                    <label for="second_password">Подтвердите пароль</label>
                    <input type="text" class="registration__form-block-input" id="second_password" name="second_password" required placeholder="Повторите пароль">
                    <span class="error" id="second_password_error"></span>
                </div>

                <a href="login.php">Уже есть аккаунт? <u>Войти</u></a>
                <input type="submit" class="registration__form-btn" id="send_data" value="Зарегистрироваться" disabled></input>

            </form>
        </div>
    </div>

    <?php require '../footer.php' ?>

    <script>
        $('input').bind('blur', function(e) {
            $('input').each(function() {
                $(this).removeClass('error_input');
            });
            $('.error').hide();

            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var first_password = $('#first_password').val();
            var second_password = $('#second_password').val();

            $.ajax({
                type: "POST",
                url: "reg.php",
                data: {
                    'name': name,
                    'email': email,
                    'phone': phone,
                    'first_password': first_password,
                    'second_password': second_password
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
    </script>
</body>

</html>