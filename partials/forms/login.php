<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="/css/registration.css" type="text/css">
    <title>Knopka</title>
</head>

<body>
    <div class="container">
        <?php require "../header.php" ?>
        <div class="registration">
            <div class="registration__title">
                <h2>Вход</h2>
                <img src="/img/pets_img/guchi.png" alt="tabi">
            </div>
            
            <form action="login_check.php" method="post" class="registration__form">

                <div class="registration__form-block">
                    <label for="email">Email</label>
                    <input type="text" class="registration__form-block-input" id="email" name="email" value="<?=@$email;?>" required placeholder="priut@google.com">
                    <span class="error" id="email_error"></span>
                </div>

                <div class="registration__form-block">
                    <label for="first_password">Пароль</label>
                    <input type="text" class="registration__form-block-input" id="first_password" name="first_password" required placeholder="********">
                    <span class="error" id="first_password_error"></span>
                </div>       

                <a href="registration.php">Нет аккаунта? <u>Зарегистрироваться</u></a>
                <input type="submit" class="registration__form-btn" id="send_data" value="Войти"></input>
                
            </form>
        </div>
    </div>

    <?php require '../footer.php' ?>

</body>
</html>

