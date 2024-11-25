<header class="header">
    <div class="header__logo">
        <a href="/index.php" id="open_pop_up">
            <img src="/img/logo.svg" alt="Кнопка">
        </a>
    </div>
    <ul class="header__menu">
        <li><a href='/partials/pets/body.php'>Наши животные</a></li>
        <li><a href="#">О нас</a></li>
        <li><a href="#">Новости</a></li>
        <li><a href="#">Контакты</a></li>
    </ul>
    <div class="header__btns">
        <button class="header__btns__help">Помочь приюту</button>
        <div class="header__btns__avatar">
            <!-- <a href="/partials/account/account_body.php">;
            <img src="/img/avatar.png" alt="avatar">;
            </a> -->
            <?php
                session_start();
                if(isset($_SESSION['id_user'])) {
                    echo '<a href="/partials/account/account_body.php">';
                    echo '<img src="/img/avatar.png" alt="avatar">';
                    echo '</a>';
                } else {
                    echo '<a href="/partials/forms/login.php">';
                    echo '<img src="/img/avatar.png" alt="avatar">';
                    echo '</a>';
                }
            ?>
        </div>
    </div>
</header>
