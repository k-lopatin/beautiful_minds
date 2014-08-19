<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Разбуди интелект! | Мозговой штурм?</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

    <!--<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOTFFHfkbIVlNQzCf_Batc4V-WLTzH74c&sensor=TRUE">
    </script>
    <script type="text/javascript" src="assets/frontend/js/google_maps.js"></script>-->
    <script type="text/javascript" src="assets/frontend/js/main.js"></script>
    <script type="text/javascript" src="assets/frontend/js/slider.js"></script>

    <link rel="stylesheet" href="assets/frontend/css/main.css">
</head>
<body>

    <!--<div id="map_canvas"></div>-->
    <div id="slideshow">
        <div id="slidesContainer">
            <div class="slide">
                <img src="/assets/frontend/img/p1.jpg" class="slide">
            </div>
            <div class="slide">
                <img src="/assets/frontend/img/p2.jpg" class="slide">
            </div>
            <div class="slide">
                <img src="/assets/frontend/img/p3.jpg" class="slide">
            </div>
            <div class="slide">
                <img src="/assets/frontend/img/p4.jpg" class="slide">
            </div>
        </div>
    </div>
    <div id="top_login">
        <input type="text" name="login" value="" placeholder="логин">
        <input type="text" name="password" value="" placeholder="пароль">
        <input type="submit" value="Войти">
    </div>

    <div id="container">
        <h1>Мозговой штурм!</h1>
        <ul>
            <li>Выбери город, который хочешь завоевать</li>
            <li>Отвечай вопросы и получай поддержку населения</li>
            <li>Если соберешь достаточно голосов в свою поддержку, станешь главой этого города и сможешь собирать дань с жителей</li>
            <li>Узнавай правильные ответы, а также пояснения к ним, чтобы повысить уровень своей эрудиции</li>
            <li>Следи, чтобы в твоем городе не возникла революция, а также защищай город от других завоевателей</li>
            <li>Попробуй завоевать города друзей и покажи кто здесь главный</li>
            <li>Завоевывай больше городов, получай титулы и поднимайся в рейтинге</li>
            <li>Прокачай свой интеллект и сообразительность вместе с нами</li>
        </ul>
        <p>Случайный город: <h3><?=$random_city?></h3></p>
    </div>


</body>
</html>