<link rel="stylesheet" type="text/css" href="/css/home.css">

<main class="home" id="home">
    <div class="home__hero">
        <div class="home__hero-info">
            <div class="home__hero-info-h">
                <h1>приют для <br>животных кнопка</h1>
                <img src="/img/bed_sticker.svg" alt="bed">
                <p>
                    Мы помогаем бездомным животным найти надежных <br>и заботливых хозяев, которые готовы подарить им свою любовь и дом.
                </p>
            </div>
            <button><a href="/partials/pets/body.php">Наши животные</a></button>
        </div> 
        <div class="home__hero-img">
            <img src="/img/hero_img.png" alt="dog">
        </div>
        
    </div>

    <div class="home__pets">
        <a href="/partials/pets/body.php">
            <div class="home__h2">
                <p>Наши</p>
                <img src="/img/our_pets_img.png" alt="">
                <p>животные</p>
            </div>
        </a>
        <div class="home__pets-cards">
            <div class="home__pets-cards-card">
                <div class="home__pets-cards-card-info">
                    <h3>Агир,</h3>
                    <p>мальчик<br>2 года</p>
                </div>
                <button class="home__pets-cards-card-btn-arrow" action="">
                    <div></div>
                </button>
            </div>
            <div class="home__pets-cards-small">
                <div class="home__pets-cards-card card-small">
                    <div class="home__pets-cards-card-info">
                        <h3>Гуччи,</h3>
                        <p>девочка<br>2,5 месяца</p>
                    </div>
                    <button class="home__pets-cards-card-btn-arrow" action="">
                        <div></div>
                    </button>
                </div>
                <div class="home__pets-cards-card card-small" onclick="loadPetsContent()">
                    <h3>еще 60 животных ждут вас</h3>
                    <img src="/img/petlist.png" alt="petlist">
                    <button class="home__pets-btn">Наши животные</button>
                </div>
            </div>
        </div>
    </div>

    <div class="home__adopt">
        <div class="home__adopt-h2">
            как стать хозяином
        </div>
        <div class="home__adopt-block">
            <div class="home__adopt-block-info">
                <h4>посмотрите информацию <br>о животном</h4>
                <p>
                    Каждое животное имеет свои особенности, потребности и характер. 
                    Ознакомившись с ним заранее, вы сможете определить, подходит ли 
                    оно вам по характеру и соответствует вашему образу жизни.
                </p>
            </div>
            <div class="home__adopt-block-info">
                <h4>Заполните заявку</h4>
                <p>
                    Предоставьте информацию о себе, вашем жилье, 
                    опыте содержания животных и другие детали.
                </p>
                <button>Заполнить</button>
            </div>
            <div class="home__adopt-block-info">
                <h4>Согласование и проверка</h4>
                <p>
                    Приют проведет проверку ваших данных, чтобы убедиться, 
                    что вы можете обеспечить достойные условия для животного. 
                </p>
            </div>
            <div class="home__adopt-block-info">
                <h4>Заберите животное</h4>
                <p>
                    После успешной проверки, приют оформит все необходимые документы. 
                    После этого вы сможете забрать своего нового питомца домой и начать новую 
                    главу вашей жизни вместе с ним.
                </p>
            </div>
        </div>
    </div>
    <div class="home__support">
        <form>
            
        </form>
        <div class="home__support-qna">
            <div class="home__support-qna-block">
                <h4>Какие прививки уже сделаны животному <br>в приюте?</h4>
                <button class="home__support-qna-block-btn-arrow" action="">
                    <div></div>
                </button>
            </div>
            <div class="home__support-qna-block">
                <h4>как я могу забрать питомца?</h4>
                <button class="home__support-qna-block-btn-arrow" action="">
                    <div></div>
                </button>
            </div>
            <div class="home__support-qna-block">
                <h4>как улучшить процесс адаптации животного?</h4>
                <button class="home__support-qna-block-btn-arrow" action="">
                    <div></div>
                </button>
            </div>
            <div class="home__support-qna-block">
                <h4>какие прививки следует сделать животному?</h4>
                <button class="home__support-qna-block-btn-arrow" action="">
                    <div></div>
                </button>
            </div>
            <div class="home__support-qna-block" onclick="loadPetsContent()">
                <h4>забрать животное</h4>
                <img src="/img/petlist.png" alt="petlist">
                <button class="home__support-qna-block-btn-arrow" action="">
                    <div></div>
                </button>
            </div>
        </div>
    </div>
</main>
